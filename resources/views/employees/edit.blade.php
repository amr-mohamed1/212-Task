@extends('layout.master')

@section('title')
    All Companies
@endsection

@section('page-header')
    <!-- breadcrumb -->
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0">All Companies Data</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                    <li class="breadcrumb-item active">All Companies</li>
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
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="POST" action="{{route('employee.update',$employee->id)}}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <img style="width: 150px;border-radius: 50%;display: block;margin: 30px auto" src="{{asset('storage/'.$employee->image)}}" alt="company logo">
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Employee Name:</label>
                            <input type="text" name="name" value="{{$employee->name}}" class="form-control" id="recipient-name">
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Employee Email:</label>
                            <input type="email" name="email" value="{{$employee->email}}" class="form-control" id="recipient-name">
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Employee Password:</label>
                            <input type="password" name="password" class="form-control" id="recipient-name">
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">Company:</label>
                            <select class="custom-select form-select" name="company">
                                <option selected disabled value="">Choose the Company</option>
                                @foreach(get_companies() as $company)
                                    <option value="{{$company->id}}">{{$company->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Employee Image:</label>
                            <div id="emailHelp" class="form-text">(*if you dont want to change image, just submit the form without it*)</div>

                            <input type="file" name="img" class="form-control" id="recipient-name">
                        </div>

                            <button type="submit" class="btn btn-primary d-block m-auto px-3">Update</button>

                    </form>
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
                <div class="modal-body">

                    <form method="POST" action="{{route('company.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Company Name:</label>
                            <input type="text" name="name" class="form-control" id="recipient-name">
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Company Address:</label>
                            <input type="text" name="address" class="form-control" id="recipient-name">
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Company Logo:</label>
                            <input type="file" name="logo" class="form-control" id="recipient-name">
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




@endsection

@push('js')
    <script type="text/javascript">
        // $(document).ready( function () {
        //     $('#table_id').DataTable();
        // } );
        console.log('hello');
        var table;
        $(function (){

            table = $('#table_id').DataTable({
                processing : true,
                serverside : true,
                order:[
                    [0,'desc']
                ],
                ajax:"{{Route('companies.all')}}",
                columns:[
                    {data:'id',name:'id'},
                    {data:'name',name:'name'},
                    {data:'address',name:'address'},
                    {data:'logo',
                        "render": function ( data) {
                            return '<img src="{{asset('storage')}}/'+ data + '" width="40px">';}},
                    {data:'action',name:'action'},
                ]
            })
        });


        $('#table_id tbody').on('click', '#deleteButton', function() {
            var id = $(this).attr('company-id');
            console.log(id)
            $('#deleted_id').val(id);
        })
    </script>
@endpush
