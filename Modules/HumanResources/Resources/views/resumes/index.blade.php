@extends('layouts.theme')
@section('page_title', 'Resume Builder')
@section('meta_description', 'Skoojobs is an Online Education Department Portal that connects teachers and administrators with employers(schools) that require their expertise. Clients signup for Free to create their professional resumen and be available in our resumebank.')
@section('meta_keywords', 'Vacancies, Schools Hiring, Teachers Recruitment, School Job Portal, Education Job, Education Department, Staff Recruitment, Professional Online Resume')

@push('style')
    <link rel="stylesheet" href="{{ asset ('css/skoojob.css') }}">
    <link rel="stylesheet" href="{{ asset ('css/resume.css') }}">
   
@endpush



@section('content')


<!--==========================
    department Section
  ============================-->
  {{-- <section id="department">
    <div class="container-fluid">
      <div class="department-text">
        <div class="row">
          <div class="col-md-8 offset-md-1">
            <h3>Get the Right Fit </h3>
            <p>Everything you need to find, connect and engage the right teacher or administrator for your school       
             </p>
          </div>              
          
        </div>
            
      </div> 
    

    </div>  
  
  </section><!-- #department -->   --}}

  <section class="resume-welcome">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-7">
          <div class="content-text">
            <h3>Resume Builder</h3>
            <p>Take control of your hiring and find the ideal person quickly by using our CV Database to search over 20 million profiles.* You can browse unlimited CVs, with the option to get further information and contact up to 100 people within a month.</p>
            <a href="" class="btn btn-danger btn-get-started">Get Early Access</a>
          </div>
        </div>
        <div class="col-md-5">
            <img src="{{ asset('icons/job-dash.png') }}" alt="">
        </div>
      </div>
    </div>
  </section>
    <section class="">
      <div class="container school-section"> 
        <div class="row">
          <div class="col-md-12 order-md-2">
            <h4 class="text-center">What You Get</h4>
            <p class="text-center">  
              Take control of your hiring and find the ideal person quickly by
               {{-- using our CV Database to search over 20 million profiles.* --}}
            </p>
            <div class="row">

              <div class="col-md-6"> 
                <div class="resume-advantage">
                  <div class="row no-gutters">
                    <div class="col-md-2 col-sm-3 text-right">
                      <div class="icon">
                        <img src="{{ asset('icons/white-visual.png') }}" alt="job-alert" class="img-responsive">
                      </div>                      
                    </div>
                    <div class="col-md-10 col-sm-9 info">
                        <h6>Visually Striking Resume    </h6>
                          <p> Our resume layout optimizer makes sure all your content is aligned and organized so your resume looks like a work of art. </p>                     
                    </div>
                  </div>
                </div>                
              </div>   
              
              <div class="col-md-6"> 
                <div class="resume-advantage">
                  <div class="row no-gutters">
                    <div class="col-md-2 col-sm-3 text-right">
                      <div class="icon">
                        <img src="{{ asset('icons/white-visual.png') }}" alt="job-alert" class="img-responsive">
                      </div>                      
                    </div>
                    <div class="col-md-10 col-sm-9 info"> 
                      <h6>Unlimited Downloads   </h6>
                      <p> Our Resume Builder subscription gives you the flexibility to edit and download your resume unlimited time </p>                     
                    </div>
                  </div>
                </div>                
              </div> 
              
              <div class="col-md-6"> 
                <div class="resume-advantage">
                  <div class="row no-gutters">
                    <div class="col-md-2 col-sm-3 text-right">
                      <div class="icon">
                        <img src="{{ asset('icons/white-visual.png') }}" alt="job-alert" class="img-responsive">
                      </div>                      
                    </div>
                    <div class="col-md-10 col-sm-9 info"> 
                      <h6>Higher Recruiter Views </h6>
                      <p> Our resume builder increases the chances of your resume getting read. </p>                     
                    </div>
                  </div>
                </div>                
              </div> 

              <div class="col-md-6"> 
                <div class="resume-advantage">
                  <div class="row no-gutters">
                    <div class="col-md-2 col-sm-3 text-right">
                      <div class="icon">
                        <img src="{{ asset('icons/white-visual.png') }}" alt="job-alert" class="img-responsive">
                      </div>                      
                    </div>
                    <div class="col-md-10 col-sm-9 info"> 
                      <h6>Get your CV past screening software</h6>
                      <p>Most of the resume filtering is done by machine. So, it becomes very important to design your CV as per the ATS</p>
                    </div>
                  </div>
                </div>                
              </div> 
            </div>
          </div>
         
        </div>
      </div>

     
      
    </section>
 
  
  <section class="intro-section">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 text-center">
          <h4>How it Works</h4>      
          <p>Skoojobs provides you with tools to make hiring easier and faster.</p>
        </div>      
      </div>
          <div class="row" id="why-schoolmag">       
            <div class="col-md-3 col-sm-6 mb-2 text-center">
              <div class="item">
                <img src="{{ asset ('icons/create-account.png') }}" alt="Job Posting">
                <h5>Create Account</h5>
                <p>Increase your job visibility, reach more clients and have your job sent to clients on alert pool </p>
              </div> 
            </div> 
            <div class="col-md-3 col-sm-6 mb-2 text-center">
              <div class="item">
                <img src="{{ asset ('icons/assessment.png') }}" alt="Job Posting">
                <h5>Update your Credentials</h5>
                <p>Increase your job visibility, reach more clients and have your job sent to clients on alert pool </p>
              </div>
            </div> 
            <div class="col-md-3 col-sm-6 mb-2 text-center">
              <div class="item">
                <img src="{{ asset ('icons/applications.png') }}" alt="Job Posting">
                <h5>Review your Resume</h5>
                {{-- <p>Find and engage with top quality talents in our database when you need them </p> --}}
                <p>streamline your talents acquisition; search, review, and connect with clients that fit the position </p>
                </div>
            </div> 
            <div class="col-md-3 col-sm-6 mb-2 text-center">
              <div class="item">
                <img src="{{ asset ('icons/applications.png') }}" alt="Job Posting">
                <h5>Preview/Download</h5>
                <p>Send us your requirements. We can get you the qualified clients you need fast.</p>
              </div>
            </div>   
          </div>  
    </div>
  </section>



  

  {{-- <section id="benefit2">
    <div class="container-fluid" id="benefits2">
      <div class="row">
        <div class="col-md-3 col-sm-6 text-center">
          <img src="{{asset ('icons/assessment.png')}}" alt="Alert">
          <h5>Attract the best Hands </h5>
          <p> Put your vacancies in front of top educators and administrators with the right experience for the job
            </p>
        </div>

        <div class="col-md-3 col-sm-6 text-center">
          <img src="{{asset ('icons/applications.png')}}" alt="Alert">
          <h5>Hire on Demand  </h5> 
          <p> Build your own talent pool of qualified clients from our growing database to make ongoing hiring easier
            </p>
        </div>

        <div class="col-md-3 col-sm-6 text-center">
          <img src="{{asset ('icons/smart-decision.png')}}" alt="Alert">
          <h5>Make smarter hiring decisions</h5>  
          <p> Effectively manage the entire hiring process with easy to use tools that keep everyone in the loop
            </p>
        </div>      
        
        <div class="col-md-3 col-sm-6 text-center">
          <img src="{{asset ('icons/time-money.png')}}" alt="Alert">
          <h5>Time Is Money - Save Both</h5>  
          <p> Switching from paper applications to our online recruitment solution saves invaluable productive time.
          </p>
        </div>
      </div>
    </div>    
  </section> --}}




  <section class="cta">
    <div class="container">
      <div class="row">
        <div class="col-md-6 text-left">
            <h2>Take the next Step</h2>
            <h5>Start the next chapter in your department</h5>
        </div>
        <div class="col-md-3 offset-md-3">
          <a href="" class="btn btn-purple btn-sm btn-block">Get Early Access</a>

        </div>
      </div>
    </div>
  </section>
  

@endsection

@push('script')
	<script src="{{ asset ('plugins/isotope/isotope.pkgd.min.js')}}"></script>
@endpush