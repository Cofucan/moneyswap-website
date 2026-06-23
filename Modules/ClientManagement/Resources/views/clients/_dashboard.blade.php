<div class="row m-t-20 m-b-20">
    <!-- ./col -->
    <div class="col-lg-3 col-md-3 col-sm-3 col-sm-6">
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
                <h3>{{  $client->Wallet->available_balance ?? 0}}</h3>

                <h5>Wallet Balance</h5>
            </div>
            <div class="icon">
                <i class="fa fa-file-zip-o"></i>
            </div>
            @if(!is_null($client->wallet))
            <a href="{{route ('wallets.show', $client->Wallet)}}" class="small-box-footer">View <i class="fa fa-arrow-circle-right"></i></a>
            @else <a href="#" class="small-box-footer">Wallet Balance</a>
            @endif
        </div>
    </div>
    <div class="col-lg-3  col-md-3 col-sm-3 col-sm-6">
        <!-- small box -->
        <div class="small-box bg-blue">
            <div class="inner">
                <h3>{{  $client->total_payments }}</h3>
                <h5>Total Revenue</h5>
            </div>
            <div class="icon">
                <i class="fa fa-money"></i>
            </div>
            <a href="#" class="small-box-footer">Revenue History</a>
        </div>
    </div>
    <div class="col-lg-3  col-md-3 col-sm-3 col-sm-6">
        <!-- small box -->
        <div class="small-box bg-red">
            <div class="inner">
                <h3>{{  $client->amount_owed}}</h3>
                <h5>Active Debt</h5>
            </div>
            <div class="icon">
                <i class="fa fa-list"></i>
            </div>
            <a href="#" class="small-box-footer">View Bills</a>
        </div>
    </div>
    <div class="col-lg-3  col-md-3 col-sm-3 col-sm-6">
        <!-- small box -->
        <div class="small-box bg-black">
            <div class="inner">
                <h3>{{  $client->archived_debt}}</h3>
                <span>Archived Debt</span>
            </div>
            <div class="icon">
                <i class="fa fa-list"></i>
            </div>
            <a href="#" class="small-box-footer">Archived Debt</a>
        </div>
    </div>
</div>
<div class="row m-t-20 m-b-20">
    <!-- ./col -->
    <div class="col-lg-3 col-md-3 col-sm-3 col-sm-6">
        <!-- small box -->
        <div class="small-box bg-purple">
            <div class="inner">
                <h3>{{  $client->enrolments->count()}}</h3>
                <h5>Enrolments</h5>
            </div>
            <div class="icon">
                <i class="fa fa-file-zip-o"></i>
            </div>
            <a href="#" class="small-box-footer">Details</a>
        </div>
    </div>
    <div class="col-lg-3  col-md-3 col-sm-3 col-sm-6">
        <!-- small box -->
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{  $client->subscriptions->count() }}</h3>
                <h5>Subscriptions</h5>
            </div>
            <div class="icon">
                <i class="fa fa-money"></i>
            </div>
            <a href="#" class="small-box-footer">Subscription History</a>
        </div>
    </div>
    <div class="col-lg-3  col-md-3 col-sm-3 col-sm-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3>{{  $client->invoices->count()}}</h3>
                <h5>Bills</h5>
            </div>
            <div class="icon">
                <i class="fa fa-list"></i>
            </div>
            <a href="#" class="small-box-footer">View Bills</a>
        </div>
    </div>
    <div class="col-lg-3  col-md-3 col-sm-3 col-sm-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3>{{  $client->interventions->count()}}</h3>
                <span>Well-Being Tickets</span>
            </div>
            <div class="icon">
                <i class="fa fa-list"></i>
            </div>
            <a href="#" class="small-box-footer">View All</a>
        </div>
    </div>
</div>
