<?php
namespace App\Traits;
use App\Models\Member;
use App\Models\Profile;
use App\Models\NextofKin;
use App\Models\Bank;
use App\Models\MemberAccount;
use App\Models\Page;
use App\Models\MembershipType;
use Illuminate\Support\Facades\Mail;
use App\Mail\MemberElevation;
use App\Mail\RewardMember;
use Illuminate\Support\Facades\Auth;
use App\Traits\PersonTrait;
use App\Traits\OrderTrait;
use App\Traits\BankTrait;
use Session;
use DB;

trait MemberTrait {
use PersonTrait;
use OrderTrait;
use BankTrait;

public function memberstats()
{
    return DB::table('members')
    ->selectRaw('count(*) as total')
    ->selectRaw("count(case when status = 'Moderating' then 1 end) as moderating")
    ->selectRaw("count(case when status = 'Approved' then 1 end) as approved")
    ->selectRaw("count(case when status = 'Accepted' then 1 end) as accepted")
    ->selectRaw("count(case when status = 'Closed' then 1 end) as closed")
    ->first();
}

public function makemember()
{

    if($this->SavePerson())
    {
        if($this->addUser()){
            $this->saveMember();                
            return $this->user;
        }
        return $this->person->delete();
    }
}    

public function SaveMember()
{
    $this->member = new Member;                    
    $this->member->referral_code = !empty($this->data['referral_code']) ? $this->data['referral_code'] : $this->getReferralCode();
    $this->member->person_id = !empty($this->data['person_id']) ? $this->data['person_id'] : $this->person->id;
    $this->member->membership_type_id = !empty($this->data['membership_type_id']) ? $this->data['membership_type_id'] : $this->DefaultMembershipTypeId();            
    //$this->member->organization_id = !empty($this->data['organization_id']) ? $this->data['organization_id'] : NULL;            
    $this->member->payment_method = !empty($this->data['payment_method']) ? $this->data['payment_method'] : NULL;
    $this->member->status = !empty($this->data['status']) ? $this->data['status'] : 'New';      
    if(isset($this->parent_code)|| isset($this->data['parent_code']))
    {
        $parent = Member::where('referral_code', !empty($this->data['parent_code']) ? $this->data['parent_code'] : $this->parent_code)->first();
        $this->member->appendToNode($parent)->save();
        //send notification to parent
        return $this->member;
    }
    return $this->member->save();
}

public function DefaultMembershipTypeId()
{
$membershiptype = MembershipType::where('is_default', true)->first();
return $membershiptype->id;
} 
public function upgrade()
{
    //
    $membership_type_id = Auth::user()->Person->member->membership_type_id;
    $page_tag = 'subscriptions';
    $page = Page::where('page_tag', $page_tag)->first();
    $page->increment('page_views');
    $membershiptypes = MembershipType::where('id', '<>', $membership_type_id)->get();
    return view ('membershiptypes.upgrade', compact('membershiptypes', 'page'));
}

public function Orderables(MembershipType $membershiptype)
{        
    $products = $this->loadOrderable($membershiptype->id);         
    return view ('members.orderable', compact('products', 'membershiptype'));
}

public function SaveMembershipType($data)
    {
        $this->membershiptype = new MembershipType();
        $this->membershiptype->title_name     = $data['title_name'];
        $this->membershiptype->signup_balance    = !empty($data['signup_balance']) ? $data['signup_balance'] : '0';
        $this->membershiptype->overview    = !empty($data['overview']) ? $data['overview'] : '';        
        $this->membershiptype->benefits    = !empty($data['benefits']) ? $data['benefits'] : '';        
        $this->membershiptype->parent_id = !empty($data['parent_id']) ? $data['parent_id'] : '0';
        $this->membershiptype->is_default = !empty($data['is_default']) ? $data['is_default'] : '1';
      
        // $this->membershiptype->published  = $data['published'] ?: '';

        if ( ! $this->membershiptype->save()) {
            //code to delete create images
            return redirect()->back()->withInput()->withErrors($validator);
        }

        return $this->membershiptype;
    }

    public function memberOrders($reference_code)
    {
        $member = Member::where('reference_code', $reference_code)->firstOrFail();
        $orders = $member->orders;
    }

    public function addNextofkin()
    {
        if($this->SavePerson())
        {
            $this->nextofkin = new NextofKin;
            $this->nextofkin->member_id = !empty($this->data['member_id']) ? $this->data['member_id'] : $this->member->id; 
            $this->nextofkin->person_id = $this->person->id;
            $this->nextofkin->relationship_id = $this->data['relationship_id'];
            $this->nextofkin->email = !empty($this->data['email']) ? $this->data['email'] : $this->email;
            $this->nextofkin->telephone = !empty($this->data['telephone']) ? $this->data['telephone'] : $this->telephone;
            if ( ! $this->nextofkin->save()) {
                return redirect()->back()->withInput()->withErrors($validator);
            }
            return $this->nextofkin;
        }
    }


    public function upgrademembership($reference_code)
    {
        $member = $this->loadmember($reference_code);
        if(isset($profile))
        {            
            $this->membershiptype = MembershipType::where('parent_id', $profile->Member->membership_type_id)->first();                 
            if(Member::where('id', $profile->Member->id)->update(['membership_type_id'=>$this->membershiptype->id]))
            {
                //send notification
                $milestone = $this->milestone;              
                return Mail::to($profile->email)->send(new MemberElevation($profile, $milestone));
            }
        }
      
    }
    public function loadmember($reference_code)
    {
        return Member::where('reference_code', $reference_code)->firstOrFail();
    }

    public function rewardUplink($profile)
    {    
       // get profile sponsor id
        $member = Member::where('profile_id', $profile->profile_id)->first();
        if(is_null($member))
        {
            return $profile;
        }
        $reward = $this->milestone->bonus_value;
        $member->referral++;
        $member->ledger_balance =+$reward;
        $member->available_balance =+$reward;
        //save & notify
        if($member->save())
        {
            return Mail::to($member->Profile->email)->send(new RewardMember($member, $reward));
        }

    }    

    public function getReferralCode()
    {
        $referral_code = $this->generateReferralCode();
        if(Member::where('referral_code', $referral_code)->exists())
        {
            return $this->getReferralCode();
        }
        return $referral_code;        
    }

    public function generateReferralCode()
    {        
        return str_slug($this->person->first_name.rand(1111,9999));
    }
   
  
    public function loadorders($member_id)
    {
        //
        $orders = $profile->Orders;
        return view('orders.profile', compact('orders','profile'));
    }

    
}
