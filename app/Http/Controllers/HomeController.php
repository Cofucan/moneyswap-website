<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Modules\AccountManagement\Entities\Currency;
use Modules\ContentManagement\Entities\Testimonial;
use App\Models\Enquiry;
use App\Models\Brief;
use Modules\ClientManagement\Entities\Client;
//use Modules\ProfileManagement\Entities\Profile;
use Modules\ProfileManagement\Entities\Agent;



use Auth;
use Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    public function welcome()
    {
        return view('welcome');
    }

    public function dashboard()
    {
        return view('dashboard');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if ((Auth::user()->change_password == '1')) {
            return redirect(route('changepassword'));
        }
        $enquiries = Enquiry::where('status', 'Pending')->get();
        $profile = Auth::user()->profile;

        switch ($profile->role_id) {
            case '1'://platform
                $testimonials = Testimonial::active()->get();
                $briefs = Brief::active()->get();
                return view('dashboard', compact('enquiries', 'testimonials', 'briefs'));
            break;
            case '2': // admin
           
            return view('dashboard', compact('enquiries'));
            break;

            case '3'://manager

    
                return view('dashboard', compact('enquiries'));
            break;

            case '4'://cashier

            $expenses = Expense::where('status', 'Approved')->get();
            // $profiles = Profile::customer()->get();
            return view('dashboard', compact( 'expenses'));
            break;

            case '5'://warehouse
            //$wishes = Wish::with('Warehouse')->whereWarehouseId(Auth::user()->Person->Warehouse->id)->get();
            $packages = Package::published()->get()->pluck("title", "id");
            $banks = Bank::with('Organization')->get();
            $transactionMethods = TransactionMethod::wherePublished(true)->get();
            $currencies = Currency::all()->pluck("label", "code");
            return view('dashboard', compact('wishes', 'packages', 'banks', 'currencies', 'transactionMethods'));
            break;
            case '6'://Donor
            return view('dashboard');
            break;
            case '7'://Volunteer
            return view('dashboard');
            break;
            // case '9'://Agent
            //     if(Agent::where('profile_id', $profile->id)->doesntExist())
            //     {
            //         return redirect()->route('agents.new', $profile)->with('error','Kindly update your personal details!');
            //     }
            //     $agent = Agent::byProfileId($profile->id);
            //     if($agent->clients->count() > 0)
            //     {
            //         return view('dashboard', compact('agent', 'profile'));

            //     }
            //     return redirect()->route('clients.new', $agent)->with('success','you have not norminated any orphan for scholarship!');
            // break;
            case '10'://Client
            return view('dashboard');
            break;

            default:
            return '/dashboard';
            break;
        }

    }
    public function feedback()
    {
        return view('feedback');
    }

}
