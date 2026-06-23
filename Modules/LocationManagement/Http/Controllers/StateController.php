<?php

namespace Modules\LocationManagement\Http\Controllers;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

use Datatables;
use Modules\LocationManagement\Entities\State;
use Modules\LocationManagement\Entities\City;
use Modules\LocationManagement\Entities\Country;
use Illuminate\Http\Request;
use App\Http\Requests\StateFormRequest;
use Illuminate\Support\Str;
use DB;
use Image;
use Session;
use Excel;
use File;


class StateController extends Controller
{

    // public function getstatelist(Request $request)
    // {
    //     $states = DB::table("states") ->where("country_code",$request->country) ->pluck("state_name","id");
    //     return response()->json($states);
    // }

    public function getcitylist(Request $request)
    {
        $state = $request->state;
       $cities = City::where('state_id', $state)->pluck("city_name","id");
        return response()->json($cities); 
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $states = State::published()->get();
        $countries = Country::all()->pluck("country_code");
        return view('locationmanagement::states.index', compact('states', 'countries'));
    }

    public function manage()
    {
        //

        $states = State::all ();
        return view('locationmanagement::states.manage' )->withStates ( $states );
    }

    /**

     * Process ajax request.

     *

     * @return \Illuminate\Http\JsonResponse

     */

    public function getData()

    {

        return view('states');

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('locationmanagement::states.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         //
         $this->validate($request, [

            'state_code' => 'required',
            'country_code' => 'required',
            'state_name' => 'required'

        ]);
        $state = new State();
        $state->state_code = $request->state_code;
        $state->country_code = $request->country_code;
        $state->state_name = $request->state_name;
        $state->longitude = $request->longitude;
        $state->latitude = $request->latitude;
        $state->population_estimate = $request->population_estimate;
        $state->about_state = $request->about_state;
        if ( ! $state->save()) {
            //code to delete create images
            Session::flash('error', 'Error inserting the data..');
            return redirect()->back()->withInput()->withErrors($validator);
        }

       Session::flash('success', 'State Added successfully.');
       return redirect()->back()->with('success','State Added successfully.');

    }

    public function changeimage(Request $request)
    {
        //
        $this->validate($request, [
            'state_id' => 'required',
            'display_image' => 'required',
            'display_image.*' => 'image|mimes:jpeg,jpg,png,gif|max:750'
        ]);

        $this->state = state::findorFail($request->state_id);
        if ($request->hasFile('display_image')) {
            $this->display_image = $request->file('display_image');
            $this->saveDisplayImage() ;
            $this->state->save();
        }
        return redirect()->back()->with('success','Display image Updated successfully.');
       //return redirect()->action('ProductController@show', $this->product->id)->with('success','Display Updated successfully.');
    }

    public function saveDisplayImage()
    {
             // create new directory for uploading image if doesn't exist
         if ( ! File::exists('images/states')) {
             $person_img = File::makeDirectory('images/states', 0777, true);
         }
         $filename = Str::slug($this->state->headline).'_'.time().'.'.$this->display_image->getClientOriginalExtension();
         $state_image = 'images/states/' . $filename;
         $this->state->display_image     = $state_image;
         // upload image to server
         Image::make($this->display_image)->fit('1500', '400', function ($constraint) {
             $constraint->upsize();
         })->save($state_image);
 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\State  $state
     * @return \Illuminate\Http\Response
     */
    public function show(State $state)
    {
        //
        return view('locationmanagement::states.show',compact('state'));
    }

  
    public function state($tag)
    {
        //
        $state = State::where('tag',  $tag)->firstOrFail();
        return view('locationmanagement::states.state',compact('state'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\State  $state
     * @return \Illuminate\Http\Response
     */
    public function edit(State $state)
    {
        //
        return view('locationmanagement::states.edit',compact('state'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\State  $state
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, State $state)
    {
        $this->validate($request, [            
            'state_name' => 'required',
        ]);
        //dd($request->all());
        
        if ( ! $state->update($request->all())) {
            return redirect()->back()->withInput()->withErrors('error', 'Error inserting the data..');
        }

       return redirect()->back()->with('success','State Updated successfully.');
    }

    public function upload()
    {
        return view('states.upload');
    }

    public function import(Request $request){
        //validate the xls file
        $this->validate($request, array(
            'file'      => 'required'
        ));

        if($request->hasFile('file')){
            $extension = File::extension($request->file->getClientOriginalName());
            if ($extension == "xlsx" || $extension == "xls" || $extension == "csv") {

                $path = $request->file->getRealPath();
                $data = Excel::load($path, function($reader) {
                })->get();
                if(!empty($data) && $data->count()){

                    foreach ($data as $key => $value) {
                        $insert[] = [
                            'country_code' => $value->country_code,
                            'state_code' => $value->state_code,
                            'state_name' => $value->state_name,

                            'longitude' => $value->longitude,
                            'latitude' => $value->latitude,

                        ];
                    }

                    if(!empty($insert)){

                        $insertData = DB::table('states')->insert($insert);
                        if ($insertData) {
                            Session::flash('success', 'Your Data has successfully imported');
                        }else {
                            Session::flash('error', 'Error inserting the data..');
                            return back();
                        }
                    }
                }

                return back();

            }else {
                Session::flash('error', 'File is a '.$extension.' file.!! Please upload a valid xls/csv file..!!');
                return back();
            }
        }
    }

    public function export($type)
    {


        $data = State::get()->toArray();
        return Excel::create('realtystates', function($excel) use ($data) {
            $excel->sheet('states', function($sheet) use ($data)
            {
                $sheet->cell('A1', function($cell) {$cell->setValue('Country ');   });
                $sheet->cell('B1', function($cell) {$cell->setValue('state Code');   });
                $sheet->cell('C1', function($cell) {$cell->setValue('State');   });
                $sheet->cell('D1', function($cell) {$cell->setValue('State Icon');   });
                $sheet->cell('E1', function($cell) {$cell->setValue('Estimated Population');   });
                $sheet->cell('F1', function($cell) {$cell->setValue('About');   });
                if (!empty($data)) {
                    foreach ($data as $key => $value) {
                        $i= $key+2;
                        $sheet->cell('A'.$i, $value['country_code']);
                        $sheet->cell('B'.$i, $value['state_code']);
                        $sheet->cell('C'.$i, $value['state_name']);
                        $sheet->cell('C'.$i, $value['state_symbol']);
                        $sheet->cell('C'.$i, $value['population_estimate']);
                        $sheet->cell('C'.$i, $value['about_state']);
                    }
                }
            });
        })->download($type);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\State  $state
     * @return \Illuminate\Http\Response
     */
    public function destroy(State $state)
    {
        //
        $state->delete();
        return redirect()->route('states.index')
        ->with('success','State deleted successfully');
    }
}
