
       {{-- <div class="container-fluid px-xl-5"> --}}
        <section class="mt-2">

          <div class="row">
            <div class="col-lg-3 col-xs-6 col-sm-6">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                  <h3>{{$testimonials->count()}}</h3>
                  <h5>Testimonials</h5>
                </div>
                <div class="icon">
                  <i class="fa fa-shopping-basket"></i>
                </div>
                <a href="{{ url('testimonials/manage')}}" class="small-box-footer">View all <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <div class="col-lg-3 col-xs-6 col-sm-6">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                  <h3>{{$enquiries->count()}}</h3>
                  <h5>Enquiries</h5>
                </div>
                <div class="icon">
                  <i class="fa fa-shopping-basket"></i>
                </div>
                <a href="{{ url('enquiries/manage')}}" class="small-box-footer">View all <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <div class="col-lg-3 col-xs-6 col-sm-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3>{{ $expertises->count()}}</h3>

                  <h5>Services</h5>
                </div>
                <div class="icon">
                  <i class="fa fa-users"></i>
                </div>
                <a href="{{url('expertises/manage')}}" class="small-box-footer"><i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <div class="col-lg-3 col-xs-6 col-sm-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3>{{ $briefs->count() }}</h3>
                  <h5>Quote Request</h5>
                </div>
                <div class="icon">
                  <i class="fa fa-info-circle"></i>
                </div>
                <a href="{{url('briefs/manage')}}" class="small-box-footer">View all  <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
          </div>



          <div class="row">

          </div>

        </section>


      {{-- </div> --}}



  @push('scripts')
  {{-- {!! $chart1->renderChartJsLibrary() !!}
  {!! $chart1->renderJs() !!} --}}
  {{-- {!! $chart2->renderJs() !!}
  {!! $chart3->renderJs() !!} --}}
  @endpush
