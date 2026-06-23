<?php

namespace Modules\OrganizationManagement\Traits;

use Illuminate\Http\Request;
use Modules\OrganizationManagement\Entities\Organization;
use Modules\ContentManagement\Traits\PageTrait;
use Modules\OrganizationManagement\Entities\Industry;
use Modules\MerchantManagement\Entities\Merchant;
use Modules\OrganizationManagement\Entities\Outlet;
use Carbon\carbon;
use Session;
use File;
use Image;
use Auth;
use Modules\LocationManagement\Traits\AddressTrait;

trait OrganizationTrait {
    use AddressTrait;
    use PageTrait;

    /**
     * Does very basic image validity checking and stores it. Redirects back if somethings wrong.
     * @Notice: This is not an alternative to the model validation for this field.
     *
     * @param Request $request
     * @return $this|false|string
     */
    public function makeOrganization()
    {
        return Organization::firstOrCreate(
            ['legal_name' =>  ucfirst(!empty($this->data['legal_name']) ? $this->data['legal_name'] : $this->row['brand'])],
            [
                'published' => 0,
                'industry_id' => !empty($this->data['industry_id']) ? $this->data['industry_id'] : NULL,
                'user_id' => !empty(Auth::id()) ? Auth::id() : NULL,
                'status' => !empty($this->data['status']) ? $this->data['status'] : 'Unverified'
            ]
        );
    }
    public function saveOrganization()
    {
        $this->organization =  new Organization;
        $this->organization->legal_name = $this->data['legal_name'];
        $this->organization->page_id = !empty($this->data['page_id']) ? $this->data['page_id'] : NULL;
        $this->organization->profile_id = !empty($this->data['profile_id']) ? $this->data['profile_id'] : NULL;
        $this->organization->date_started = !empty($this->data['date_started']) ? $this->data['date_started'] : NULL;
        $this->organization->reg_number = !empty($this->data['reg_number']) ? $this->data['reg_number'] : NULL;
        $this->organization->vat_number = !empty($this->data['vat_number']) ? $this->data['vat_number'] : NULL;
        $this->organization->slogan = !empty($this->data['slogan']) ? $this->data['slogan'] : NULL;
        $this->organization->trading_name = !empty($this->data['trading_name']) ? $this->data['trading_name'] : '';
        $this->organization->vision = !empty($this->data['vision']) ? $this->data['vision'] : NULL;
        $this->organization->mission = !empty($this->data['mission']) ? $this->data['mission'] : NULL;
        $this->organization->status = !empty($this->data['status']) ? $this->data['status'] : 'Verifying';
        if(isset($this->official_logo))
        {
            if( ! File::exists('images/organizations/')) {
            $registration_img = File::makeDirectory('images/organizations', 0777, true);
            }
            $filename = str_slug($this->organization->legal_name).'_'.time().'.'.$this->official_logo->getClientOriginalExtension();
            $official_logo = 'images/organizations/' . $filename;
            $this->organization->official_logo = $official_logo;
            Image::make($this->official_logo)->fit('389', '439', function ($constraint) {
                    $constraint->upsize();
                })->save($official_logo);
        }
        if ( ! $this->organization->save()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }
        return $this->organization;
    }

    public function getOrganization()
    {
        return Organization::updateOrCreate(
            [
                'legal_name' =>  ucfirst($request->legal_name)
            ],
            [
                'profile_id' => !empty($this->data['profile_id']) ? $this->data['profile_id'] : NULL,
                'page_id' => !empty($this->data['page_id']) ? $this->data['page_id'] : NULL,
                'completion_date' => !empty($this->data['completion_date']) ? $this->data['completion_date'] : NULL,
                'cgpa' => !empty($this->data['cgpa']) ? $this->data['cgpa'] : NULL,
                'status' => !empty($this->data['status']) ? $this->data['status'] : 'Completed',
                'visibility' => !empty($this->data['visibility']) ? $this->data['visibility'] : 'Public',
                'note' => !empty($this->data['note']) ? $this->data['note'] : NULL,
                'published' => !empty($this->data['published']) ? $this->data['published'] : '1'
            ]
        );
    }
    public function IndustryOrganization()
    {
        if(!isset($this->organization))
        {
            $this->organization = Organization::findOrFail(!empty($this->data['organization_id']) ? $this->data['organization_id'] : $this->organization_id);
        }
        $industry_id = !empty($this->industry->id) ? $this->industry->id : $this->data['industry_id'];
        $this->organization->Industries()->attach($industry_id);
        return $this->industry;
    }

    public function SectorOrganization()
    {
        if(!isset($this->organization))
        {
            $this->organization = Organization::findOrFail(!empty($this->data['organization_id']) ? $this->data['organization_id'] : $this->organization_id);
        }
        $industry_id = !empty($this->industry->id) ? $this->industry->id : $this->data['industry_id'];
        $this->organization->Industries()->attach($industry_id);
        return $this->industry;
    }



    public function saveSector()
    {
        if(isset($this->data['sector_id']) || isset($this->sector_id)){
            $this->sector = Sector::findorFail(!empty($this->data['sector_id']) ? $this->data['sector_id'] : $this->sector_id);
        }else{
            $this->sector = new Sector;
            $this->sector->industry_id = !empty($this->data['industry_id']) ? $this->data['industry_id'] : $this->getIndustryId();
        }
        $this->sector->label = $this->data['label'];
        $this->sector->overview = !empty($this->data['overview']) ? $this->data['overview'] : NULL;
        $this->sector->sector_code = !empty($this->data['sector_code']) ? $this->data['sector_code'] : Null;
        $this->sector->practitioner = !empty($this->data['practitioner']) ? $this->data['practitioner'] : $this->getSectorNoun();
        $this->sector->is_default = !empty($this->data['is_default']) ? $this->data['is_default'] : 0;
        $this->sector->published = !empty($this->data['published']) ? $this->data['published'] : 1;
        if ( !$this->sector->save()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }
        return $this->sector;
    }

    public function getDefaultSectorId()
    {
        $sector = Sector::where('is_default', true)->first();
        return $sector->id;
    }

    public function saveOutlet()
    {
        $this->outlet =  new Outlet();
        $this->outlet->organization_id = !empty($this->data['organization_id']) ? $this->data['organization_id'] : null;
        $this->outlet->outlet_type = !empty($this->data['outlet_type']) ? $this->data['outlet_type'] : 'HeadQuarter';
        $this->outlet->outlet_code = !empty($this->data['outlet_code']) ? $this->data['outlet_code'] : NULL;
        $this->outlet->address_prefix = !empty($this->data['address_prefix']) ? $this->data['address_prefix'] : 'No';
        $this->outlet->building_number = !empty($this->data['building_number']) ? $this->data['building_number'] : NULL;
        $this->outlet->label = !empty($this->data['label']) ? $this->data['label'] : (!empty($this->data['outlet_label']) ? $this->data['outlet_label'] : NULL);
        $this->outlet->telephone = !empty($this->data['telephone']) ? $this->data['telephone'] : NULL;
        $this->outlet->street_name = $this->data['street_name'];
        if (!empty($this->data['city_id'])) {
            $this->outlet->city_id = $this->data['city_id'];
        } else {
            $this->outlet->city_id = $this->makeCity()->id;
        }
        $this->outlet->published = !empty($this->data['published']) ? $this->data['published'] : true;

        if ( ! $this->outlet->save()) {
            return redirect()->back()->withInput()->withErrors('Something went wrong, please try again');
        }
        return $this->outlet;
    }

    public function saveMerchant()
    {
        $this->merchant =  new Merchant;
        $this->merchant->merchant_code = !empty($this->data['merchant_code']) ? $this->data['merchant_code'] : NULL;
        $this->merchant->verified_at = !empty($this->data['verified_at']) ? $this->data['verified_at'] : Carbon::today();
        $this->merchant->profile_id = !empty($this->data['profile_id']) ? $this->data['profile_id'] : $this->saveProfile()->id;
        $this->merchant->status = !empty($this->data['status']) ? $this->data['status'] : 'Active';
        $this->merchant->sector_id = !empty($this->data['sector_id']) ? $this->data['sector_id'] : $this->getDefaultSectorId();
        if ( ! $this->merchant->save()) {
            return redirect()->back()->withInput()->withErrors('Something went wrong, please try again');
        }
        return $this->merchant;
    }

    public function Orgpreview(Organization $organization)
    {
        $registrationStages = $this->registrationStages;
        //$organization = Organization::where("id",$id)->first();
        return view('organizations.preview', compact('organization', 'registrationStages'));
    }

   public function IndustriesList()
   {
    return Industry::all()->pluck("industry_name", "id");
   }

}
