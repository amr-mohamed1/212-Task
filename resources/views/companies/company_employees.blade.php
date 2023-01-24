@extends('layout.master')

@section('title')
    All Company Employees
@endsection

@section('page-header')
    <!-- breadcrumb -->
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0">All Company Employees Data</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                    <li class="breadcrumb-item active">All Company Employees</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')

    <!-- row -->
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-12 mb-30">
                            <div class="card card-statistics h-100">
                                <div class="card-body">


                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif


                                        <!-- Example single danger button -->
                                        <div class="btn-group d-block m-auto">
                                            <button style="display:block;margin: 30px auto;width: 150px" type="button" class="btn btn-success dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                Select The Company
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="{{route('all_company_employees')}}">All Members</a></li>
                                                <li><hr class="dropdown-divider"></li>
                                                @foreach(get_companies() as $company)
                                                <li><a class="dropdown-item" href="{{route('company_employees_view',$company->id)}}">{{$company->name}}</a></li>
                                                    <li><hr class="dropdown-divider"></li>
                                                @endforeach
                                            </ul>
                                        </div>

                                    <div class="table-responsive">
                                        <table id="table_id" class="display">
                                            <thead>
                                            <tr>
                                                <th>id</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Company</th>
                                                <th>Image</th>

                                            </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>






@endsection

{{$company_id}}
@push('js')
    <script type="text/javascript">
        var table;
        $(function (){
            table = $('#table_id').DataTable({
                processing : true,
                serverside : true,
                order:[
                    [0,'desc']
                ],
                ajax:"{{Route('company_employees',$company_id)}}",
                columns:[
                    {data:'id',name:'id'},
                    {data:'name',name:'name'},
                    {data:'email',name:'email'},
                    {data:'company_id',
                        "render": function (data) {
                            {{--return {{get_company_name(data)}} --}}
                            return data
                                ;}},
                    {data:'image',
                        "render": function ( data) {
                            return '<img src="{{asset('storage')}}/'+ data + '" width="40px">';}},
                ]
            })
        });

    </script>
@endpush
