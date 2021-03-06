@extends('layouts.starlight')
@section('title')
   Dashbord
@endsection
@section('dashbord')
    active
@endsection
@section('breadcrumb')

@endsection
@section('content')
{{-- <h2>Role: {{ Auth::user()->role }}</h2> --}}
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if (Auth::user()->role==1)
            <div class="card">
                <div class="card-header">
                    Hello Admin
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div>
                                <canvas id="myChart"></canvas>
                            </div>
                        </div>
                    </div>
<br>
<br>
                    <div class="alert alert-success">
                           <h5 class="text-center">All Orders: </h5> 
                        </div>
                        <div class="row">
                             <div class="col-12">
                                 <div id="main_section_order">
                                     <div id="main_section_table">
                                        <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th scope="col">Or N.</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Phone</th>                           
                                            <th scope="col">Address</th>                            
                                            <th scope="col">Date</th>                            
                                            <th scope="col">Total</th>                          
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($customer_order_details as $customer_order_detail)
                                                <tr> 
                                                    <td>{{ $loop->index+1 }}</td> 
                                                    <td>{{ $customer_order_detail->customer_name }}</td>             
                                                    <td>{{ $customer_order_detail->customer_email }}</td>             
                                                    <td>{{ $customer_order_detail->customer_phone }}</td>             
                                                    <td>{{ $customer_order_detail->customer_address }}</td>             
                                                    <td>{{ $customer_order_detail->created_at->diffForHumans()}}</td>             
                                                    <td>{{ $customer_order_detail->total }}</td>             
                                                </tr>
                                            @endforeach 
                                        </tbody>
                                        </table> 
                                     </div>
                                 </div>
                                    
                                </div>
                        </div>

                    <div class="row">
                        <div class="col-12">
                            <div>
                               <form action="{{ url('send/sms') }}" method="post">
                                @csrf
                                   <label for="">Numbers (Seperate by ,)</label>
                                   <textarea class="form-control" name="number" id="" rows="3"></textarea>
                                   <label for="">Messages</label>
                                   <textarea class="form-control" name="message" id="" rows="3"></textarea>
                                   <button class="mt-3 btn btn-success">Send</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div id="main_section">
                        <div id="total_user_section" class="alert alert-success">
                             Total user: {{ $users->count() }}
                        </div>
                    </div>
                    
                    <table class="table table-striped">
                        <thead>
                          <tr>
                            <th scope="col">Serial NUmber</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>                            
                            <th scope="col">Account Created At</th>                            
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr> 
                                    <td>{{ $loop->index+1 }}</td>                       
                                    <td>{{ Str::title($user->name) }}</td>
                                    <td>{{ $user->email }}</td>             
                                    <td>{{ $user->created_at->diffForHumans()}}</td>             
                                </tr>
                             @endforeach
                        </tbody>
                      </table>  
                </div>
            </div>
            @else
                @include('customer_dashbord')
            @endif
           
        </div>
    </div>
</div>
@endsection
@section('footer_scripts') 
      <script>
        // === include 'setup' then 'config' above ===
                        const labels = [
                'Cash On Delvery',
            'Credit Card',
                ];
                const data = {
                labels: labels,
                datasets: [{
                    label: 'My First dataset',
                    backgroundColor: [
                'rgb(255, 99, 132)',
                'rgb(255, 205, 86)'
                ],
                    borderColor: '#2e2e2e',
                     data: [{{ $creditcard }}, {{ $cod }}],
                }]
                };
                const config = {
                type: 'pie',
                data,
                options: {}
                };

        var myChart = new Chart(
            document.getElementById('myChart'),
            config
        );

        window.setInterval(function(){
            $("#main_section").load(window.location.href+" #total_user_section");
        },1000);


        window.setInterval(function(){
            $("#main_section_order").load(window.location.href+" #main_section_table");
        },2000);
    </script>    



@endsection
