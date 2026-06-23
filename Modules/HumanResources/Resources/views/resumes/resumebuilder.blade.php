@extends('layouts.theme')
@section('page_title', 'The Resume Builder that get the job done')
@section('meta_description', 'Skoojobs is an Education-Only jobs and career Portal that connects teachers, administrators and school support staff with employers(schools) that require their expertise.')
@section('meta_keywords', 'Vacancies, Schools Hiring, Teachers Recruitment, School Job Portal, Education Job, Education Department, Staff Recruitment, Professional Online Resume')

@push('style')
    <link rel="stylesheet" href="{{ asset ('css/skoojob.css') }}">
   
@endpush



@section('content')


<!--==========================
    skoojob Section
  ============================-->
  <section id="skoojob">
    <div class="container-fluid">
      <div class="skoojob-text">
        <div class="row">
          <div class="col-md-6 offset-md-1">
            <h3>Standout from the crowd  </h3>
            <p>Tell your Story with a simple yet stunning professional resume maker that get you noticed and hired faster!        
             </p>
              <a href="{{ url('/register') }}" class="btn-get-started btn-sm scrollto">Get Early Access</a>
              <a href="{{ url('/vacancies') }}" class="btn-get-started btn-sm scrollto">Search Resume</a>
          </div>
          
        </div>
            
      </div> 
    

    </div>  
  
  </section><!-- #skoojob -->  
    <section class="">
      <div class="container-fluid school-section"> 
        <div class="row">
          <div class="col-md-7 order-md-2">
            <h4>SkooJobs make hiring easy & cost effective for schools!   </h4>
            <p>  
                Create a simple professional resumes to get you noticed and hired faster. Our resume builder makes it easy to tell your story without fuss. .
            </p>
            <div class="row benefit-item">
              <div class="col-md-6 col-sm-6 mb-2">
                <div class="row">
                  <div class="col-md-3 text-right">
                    <img src="{{asset ('icons/assessment.png')}}" alt="Alert">
                  </div>
                  <div class="col-md-9">
                    <h5>Easy to Use </h5>
                    <p> Use the intuitive resume builder to quickly add resume content, change templates and customize fonts. No download required!
                    </p>
                  </div>
                </div>                
              </div>  
              
              <div class="col-md-6 col-sm-6 mb-2">
                <div class="row no-gutters">
                  <div class="col-md-3">
                    <img src="{{asset ('icons/applications.png')}}" alt="Alert">
                  </div>
                  <div class="col-md-9">
                    <h5>Data Security & Control  </h5> 
                    <p> We don’t share your information with anyone (unless you explicitly ask us to), and have 3 resume privacy options to ensure your data stays safe..
                    </p>
                  </div>
                </div>                
              </div> 

              <div class="col-md-6 col-sm-6 mb-2">
                <div class="row">
                  <div class="col-md-3 text-right">
                    <img src="{{asset ('icons/smart-decision.png')}}" alt="Alert">
                  </div>
                  <div class="col-md-9">
                    <h5>Share or print </h5>  
                   <p> Share your resume with a convenient link via email or social media, and export as a PDF to apply directly to an employer. </p>
                  </div>
                </div>                
              </div>  
              
              <div class="col-md-6 col-sm-6 mb-2">
                <div class="row no-gutters">
                  <div class="col-md-3">
                    <img src="{{asset ('icons/time-money.png')}}" alt="Alert">
                  </div>
                  <div class="col-md-9">
                    <h5>Track Views</h5>  
                    <p> Resume analytics will let you know when an employer views or downloads your resume, helping you avoid getting lost in the hiring process.</p>
                  </div>
                </div>                
              </div> 
            </div>

           
              <hr>
              <a href="{{ url('/departments')}}" class="btn btn-success btn-sm">Learn More</a>
              <a href="{{ url('/vacancies/create')}}" class="btn btn-primary btn-sm">Post Vacancies</a>
          </div>
          <div class="col-md-5 text-center order-md-1">
              <img src="{{asset('icons/employer.png')}}" alt="Employer" class="img-responsive">
          </div>
        </div>
      </div>

      <div class="container-fluid" id="benefits2">
          <div class="row">
            <div class="col-md-3 col-sm-6 text-center">
              <img src="{{asset ('icons/assessment.png')}}" alt="Alert">
              <h5>Attract the best Hands </h5>
              <p> Put your vacancies in front of top educators and administrators that meet the job requirements
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
            <h5>Save Money & Time    </h5>  
            <p> Switching from paper applications to our online recruitment solution saves invaluable productive time and thousands of Naira
            </p>
          </div>
        </div>            
      </div>
      
    </section>
  <section class="get-started mb-4">
    <div class="container">
      <div class="row abt" >
        <div class="col-md-8 offset-md-2">
          <h2 class="text-center">Ready To Get Hired? </h2>
          <h6 class="text-center"> Create a Job worthy resume in minutes when you sign up for Free.   </h6>
        </div>
        <div class="col-md-10 offset-md-1">
          <div class="row mt-4 ">
            <div class="col-md-3 col-sm-3 col-6" id="item">
              <div id="item">
                <img src="{{asset('icons/sign-up-solid.png')}}" alt="">
                <h6>Create Free Account</h6>
              </div>
            </div>  
            <div class="col-md-3 col-sm-3 col-6" id="item">
              <div id="item">
                <img src="{{asset('icons/jobs.png')}}" alt="">
                <h6>Provide your details </h6>
              </div>
            </div>  
            <div class="col-md-3 col-sm-3 col-6" id="item">
              <div id="item">
                <img src="{{asset('icons/job-seeker.png')}}" alt="">
                <h6>Up</h6>
              </div>
            </div>  
            <div class="col-md-3 col-sm-3 col-6" id="item">
              <div id="item">
                <img src="{{asset('icons/employ.png')}}" alt="">
                <h6>Employ </h6>
              </div>
            </div>  
          </div>
          <div class="col-md-4 offset-md-4 text-center mt-3">         
            <a href="{{url ('register')}}" class="btn btn-purple btn-block"> Get Early Access </a>
          </div>
        </div>
         
      </div>
      
    </div>
  </section> 
  
  <section class="intro-section">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 text-center">
          <h4>How Skoojobs simplifies Hiring</h4>      
          <p>Skoojobs provides you with tools to make hiring easier and faster.</p>
        </div>      
      </div>
          <div class="row" id="why-schoolmag">       
            <div class="col-md-3 col-sm-6 mb-2 text-center">
              <div class="item">
                <img src="{{ asset ('icons/applications.png') }}" alt="Job Posting">
                <h5>Free Job Posting</h5>
                <p>Increase your job visibility, reach more clients and have your job sent to clients on alert pool </p>
                <a href="{{('#')}}" class="btn btn-sm btn-success"> Promote Job</a>
              </div>
            </div> 
            <div class="col-md-3 col-sm-6 mb-2 text-center">
              <div class="item">
                <img src="{{ asset ('icons/applications.png') }}" alt="Job Posting">
                <h5>Featured Job Posting</h5>
                <p>Increase your job visibility, reach more clients and have your job sent to clients on alert pool </p>
                <a href="{{('#')}}" class="btn btn-sm btn-success"> Promote Job</a>
              </div>
            </div> 
            <div class="col-md-3 col-sm-6 mb-2 text-center">
              <div class="item">
                <img src="{{ asset ('icons/applications.png') }}" alt="Job Posting">
                <h5>Clients Search</h5>
                {{-- <p>Find and engage with top quality talents in our database when you need them </p> --}}
                <p>streamline your talents acquisition; search, review, and connect with clients that fit the position </p>
                <a href="#" class="btn btn-sm btn-success"> Search Resume</a>
              </div>
            </div> 
            <div class="col-md-3 col-sm-6 mb-2 text-center">
              <div class="item">
                <img src="{{ asset ('icons/applications.png') }}" alt="Job Posting">
                <h5>Shortlisting</h5>
                <p>Send us your requirements. We can get you the qualified clients you need fast.</p>
                <a href="#" class="btn btn-sm btn-success"> Contact Us</a>
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




  @include('partials.call-to-action')

@endsection

@push('script')
	<script src="{{ asset ('plugins/isotope/isotope.pkgd.min.js')}}"></script>
@endpush