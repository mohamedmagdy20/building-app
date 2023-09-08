@extends('dashboard.layout.app')
@section('title', 'DashBoard')
@section('content')
 <!-- start page title -->
 <div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Dashboard</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Upcube</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->

@if (auth()->user()->hasPermissionTo('Show_Statictics'))

<div class="row">
    <div class="col-xl-4 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <p class="text-truncate font-size-14 mb-2">Total Users</p>
                        <h4 class="mb-2">{{$users}}</h4>
                        <p class="text-muted mb-0"><span class="text-success fw-bold font-size-12 me-2"><i class="ri-arrow-right-up-line me-1 align-middle"></i></span>from previous period</p>
                    </div>
                    <div class="avatar-sm">
                        <span class="avatar-title bg-light text-primary rounded-3">
                            <i class="ri-user-3-line font-size-24"></i>  
                        </span>
                    </div>
                </div>                                            
            </div><!-- end cardbody -->
        </div><!-- end card -->
    </div><!-- end col -->
    <!-- end col -->
    <div class="col-xl-4 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <p class="text-truncate font-size-14 mb-2">Advertisments</p>
                        <h4 class="mb-2">{{$advertisments}}</h4>
                        <p class="text-muted mb-0"><span class="text-success fw-bold font-size-12 me-2"><i class="ri-arrow-right-up-line me-1 align-middle"></i>16.2%</span>from previous period</p>
                    </div>
                    <div class="avatar-sm">
                        <span class="avatar-title bg-light text-primary rounded-3">
                            <i class="ri-article-line font-size-24"></i>
                        </span>
                    </div>
                </div>                                              
            </div><!-- end cardbody -->
        </div><!-- end card -->
    </div><!-- end col -->

    
    <div class="col-xl-4 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <p class="text-truncate font-size-14 mb-2">Contractors</p>
                        <h4 class="mb-2">{{$ads}}</h4>
                        <p class="text-muted mb-0"><span class="text-success fw-bold font-size-12 me-2"><i class="ri-arrow-right-up-line me-1 align-middle"></i>16.2%</span>from previous period</p>
                    </div>
                    <div class="avatar-sm">
                        <span class="avatar-title bg-light text-primary rounded-3">
                            <i class="ri-article-line font-size-24"></i>
                        </span>
                    </div>
                </div>                                              
            </div><!-- end cardbody -->
        </div><!-- end card -->
    </div><!-- end col -->
  <!-- end col -->
</div><!-- end row -->

<div class="row">
    <div class="col-md-3">

        <div class="card">
            <div class="card-title text-center p-2">
                Advertisment Status       
            </div>
            <div class="card-body py-0 px-2">
                {{-- <div id="area_chart" class="apex-charts" dir="ltr"></div> --}}
                <canvas id="type-chart"></canvas>
            </div>
        </div><!-- end card -->
    </div> 
    <div class="col-md-3">

        <div class="card">
            <div class="card-title text-center p-2">
                Accounts Type       
            </div>
            <div class="card-body py-0 px-2">
                {{-- <div id="area_chart" class="apex-charts" dir="ltr"></div> --}}
                <canvas id="account-chart"></canvas>
            </div>
        </div><!-- end card -->
    </div> 
    <div class="col-md-3">

        <div class="card">
            <div class="card-title text-center p-2">
                Users Type       
            </div>
            <div class="card-body py-0 px-2">
                {{-- <div id="area_chart" class="apex-charts" dir="ltr"></div> --}}
                <canvas id="user-type-chart"></canvas>
            </div>
        </div><!-- end card -->
    </div> 
    <div class="col-md-3">

        <div class="card">
            <div class="card-title text-center p-2">
                Advertisment Type        
            </div>
            <div class="card-body py-0 px-2">
                {{-- <div id="area_chart" class="apex-charts" dir="ltr"></div> --}}
                <canvas id="status-chart"></canvas>
            </div>
        </div><!-- end card -->
    </div> 

    <div class="col-md-12">

        <div class="card">
            <div class="card-title text-center p-2">
                Categories       
            </div>
            <div class="card-body py-0 px-2">
                {{-- <div id="area_chart" class="apex-charts" dir="ltr"></div> --}}
                <canvas id="category-chart"></canvas>
            </div>
        </div><!-- end card -->
    </div> 

</div>
<!-- end row -->    
@endif


@endsection
@section('scripts')
<script>
    // Type Data
    const getType = async () => {
        const response = await fetch('{{route('home.get.type')}}');
        const data = await response.json();
        return data;
    };

    const getAcountType = async()=>{
        const response = await fetch('{{route('home.get.acount.type')}}');
        const data = await response.json();
        return data;
    }

    const getUserType = async()=>{
        const response = await fetch('{{route('home.get.user.type')}}');
        const data = await response.json();
        return data;
    }


    const getStatus= async()=>{
        const response = await fetch('{{route('home.get.ads.status')}}');
        const data = await response.json();
        return data;
    }


    
    const getCategory= async()=>{
        const response = await fetch('{{route('home.get.category.type')}}');
        const data = await response.json();
        return data;
    }


    const TypeChart = async ()=>{
        const data = await getType();
        const ctx = document.getElementById('type-chart').getContext('2d');
        const chart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Sale', 'Rent','Instead'],
                datasets: [{
                    data: [data.sale, data.rent, data.instead],
                    backgroundColor: ['#0f9cf3', '#ffbb44','#6fd088'],
                }]
            },
            options: {
                responsive: true,
                legend: {
                    position: 'bottom',
                },
                title: {
                    display: true,
                    text: 'Advertsment Types',
                },
                animation: {
                    animateScale: true,
                    animateRotate: true,
                },
            }
        });

    }
    const AccountChart = async ()=>{
        const data =  await getAcountType();
        const ctx = document.getElementById('account-chart').getContext('2d');
        const chart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Normal', 'Permium'],
                datasets: [{
                    data: [data.normal, data.permium],
                    backgroundColor: ['#564ab1', '#f1734f'],
                }]
            },
            options: {
                responsive: true,
                legend: {
                    position: 'bottom',
                },
                title: {
                    display: true,
                    text: 'Account Types',
                },
                animation: {
                    animateScale: true,
                    animateRotate: true,
                },
            }
        });

    }

    const UserTypeChart = async ()=>{
        const data =  await getUserType();
        console.log(data);
        const ctx = document.getElementById('user-type-chart').getContext('2d');
        const chart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Company', 'Personal'],
                datasets: [{
                    data: [data.company, data.personal],
                    backgroundColor: ['#5438DC', '#0097a7'],
                }]
            },
            options: {
                responsive: true,
                legend: {
                    position: 'bottom',
                },
                title: {
                    display: true,
                    text: 'User Types',
                },
                animation: {
                    animateScale: true,
                    animateRotate: true,
                },
            }
        });

    }

    const StatusChart = async ()=>{
        const data =  await getStatus();
        console.log(data);
        const ctx = document.getElementById('status-chart').getContext('2d');
        const chart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Fixed', 'Special','Normal','Draft'],
                datasets: [{
                    data: [data.fixed, data.special,data.normal,data.draft],
                    backgroundColor: ['#5438DC', '#0097a7','#f32f53','#050505'],
                }]
            },
            options: {
                responsive: true,
                legend: {
                    position: 'bottom',
                },
                title: {
                    display: true,
                    text: 'Advertisment Status',
                },
                animation: {
                    animateScale: true,
                    animateRotate: true,
                },
            }
        });

    }

    const CategoryChart = async ()=>{
        const data =  await getCategory();
        console.log(data);
        const ctx = document.getElementById('category-chart').getContext('2d');
        const chart = new Chart(ctx, {
            type: 'scatter',
            data: {
                labels: ['Residential','Commercial Units','Commercial','Investment','Industrial','Chalet','Farm','Break','Lands'],
                datasets: [{
                    type: 'bar',
                    label: 'Total Count',
                    data: [data.residential, data.commercial_units,data.commercial,data.investment,data.industrial,data.chalet,data.farm,data.break,data.lands],
                    borderColor: 'rgb(255, 99, 132)',
                    backgroundColor: 'rgba(255, 99, 132, 0.2)'
                }]
            },
            options: {
              scales: {
                y: {
                  beginAtZero: true
                }
              }
            }
        });

    }

    TypeChart()
    AccountChart()
    UserTypeChart()
    StatusChart()
    CategoryChart()
</script>
@endsection
