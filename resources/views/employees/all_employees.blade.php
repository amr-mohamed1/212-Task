@extends('layout.master')

@section('title')
    All Employees
@endsection

@section('page-header')
    <!-- breadcrumb -->
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0">All Employees Data</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                    <li class="breadcrumb-item active">All Employees</li>
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


                                <!-- Button trigger modal -->
                                    <button style="display:block;margin: auto" type="button" class="btn btn-success my-3 p-3" data-bs-toggle="modal" data-bs-target="#add_company">
                                        Add New Employee
                                    </button>

                                    <div class="table-responsive">
                                        <table id="table_id" class="display">
                                            <thead>
                                            <tr>
                                                <th>id</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Company</th>
                                                <th>Image</th>
                                                <th>Action</th>
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


    <!-- Add Modal -->
    <div class="modal fade" id="add_company" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel1">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{route('employee.store')}}" enctype="multipart/form-data">
                    <div class="modal-body">

                        @csrf
                        <div class="mb-3">
                            <label class="col-form-label">Employee Name:</label>
                            <input type="text" name="name" class="form-control" >
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">Employee Email:</label>
                            <input type="email" name="email" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">Employee Password:</label>
                            <input type="password" name="password" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">Company:</label>
                            <select REQUIRED class="custom-select form-select" name="company">
                                <option selected disabled value="">Choose the Company</option>
                                @foreach(get_companies() as $company)
                                <option value="{{$company->id}}">{{$company->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">Employee image:</label>
                            <input type="file" required name="img" class="form-control" >
                        </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                </form>
            </div>
        </div>
    </div>




    <!-- Delete Modal -->
    <div class="modal fade" id="deletemodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel2" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel2">Delete Company</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                    <form method="POST" action="{{route('employees.delete')}}">
                <div class="modal-body">
                        @method('post')
                        @csrf
                        <div class="mb-3">
                           <h3 class="text-center">Are You Sure About Delete this Employee?</h3>
                        </div>
                        <div class="mb-3">
                            <input type="hidden" id="deleted_id" name="id" class="form-control">
                        </div>


                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger m-auto">Delete</button>
                </div>
                </form>
            </div>
        </div>
    </div>

@endsection

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
                ajax:"{{Route('employees.all')}}",
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
                    {data:'action',name:'action'},
                ]
            })
        });


        $('#table_id tbody').on('click', '#deleteButton', function() {
            var id = $(this).attr('employee-id');
            console.log(id)
            $('#deleted_id').val(id);
        })
    </script>
@endpush
