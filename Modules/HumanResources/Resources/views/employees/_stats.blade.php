<div class="row m-t-20 m-b-20">
                <!-- ./col -->
                <div class="col-lg-3 col-md-3 col-sm-3 col-3 col-sm-6 col-6">
                    <!-- small box -->
                    <div class="small-box bg-gray-light">
                        <div class="inner">
                            <h3 class="text-success">{{$counter->probation }}</h3>
                            <h5 class="text-success">Probation</h5>
                        </div>
                        <div class="icon">
                            <i class="fa fa-check text-success"></i>
                        </div>
                        <a href="{{ url ('registrations/status', 'Probation')}}" class="small-box-footer"> <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-3 col-3 col-sm-6 col-6">
                    <!-- small box -->
                    <div class="small-box bg-gray-light">
                        <div class="inner">
                            <h3 class="text-success">{{$counter->confirmed }}</h3>
                            <h5 class="text-success">Confirmed</h5>
                        </div>
                        <div class="icon">
                            <i class="fa fa-check text-success"></i>
                        </div>
                        <a href="{{ url ('registrations/status', 'Shortlisted')}}" class="small-box-footer"> <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-3 col-3 col-sm-6 col-6">
                    <!-- small box -->
                    <div class="small-box bg-gray-light">
                        <div class="inner">
                            <h3 class="text-danger">{{$counter->leave }}</h3>
                            <h5 class="text-danger">On Leave</h5>
                        </div>
                        <div class="icon">
                            <i class="fa fa-times text-danger"></i>
                        </div>
                        <a href="{{ url ('registrations/status', 'Offered')}}" class="small-box-footer">  <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-3 col-3 col-sm-6 col-6">
                    <!-- small box -->
                    <div class="small-box bg-gray-light">
                        <div class="inner">
                            <h3 class="text-primary">{{$counter->left }}</h3>
                            <h5 class="text-primary">Left</h5>
                        </div>
                        <div class="icon">
                            <i class="fa fa-money"></i>
                        </div>
                        <a href="{{ url ('registrations/status', 'Enrolled')}}" class="small-box-footer"> <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>

        </div>