@extends('layouts.master')

@section('content')


    <div class="main">
        <div class="main-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel">
                            <div class="panel-heading">
                                <h3 class="panel-title">INFORMASI PERMISSION</h3>
                                <div class="right">
                                    @can('permission-create')
                                        <a href="#" class="btn btn-primary btn-lg " data-toggle="modal" data-target="#exampleModal">Tambah Permission</a>
                                    @endcan
                                </div>
                            </div>
                            <div class="panel-body">
                                <?php
                                    $i=0;
                                ?>
                                <table class="table table-hover" id="datatable">
                                    <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>NAMA PERMISSION</th>
                                        <th>DIKELOLA</th>
                                        <th>AKSI</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($data_permis as $permis)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{$permis->name}}</td>
                                            <td>{{$permis->created_at}}</td>
                                            <td>
                                                @can('permission-edit')
                                                    <a href="/permission/{{$permis->id}}/edit" class="btn btn-warning btn-sm">Ubah</a>
                                                @endcan
                                                @can('permission-delete')
                                                    <a href="#" class="btn btn-danger btn-sm delete" permission-id="{{$permis->id}}">Hapus</a>
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">TAMBAH DATA PERMISSION</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/permission/create" method="POST">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Nama Permission</label>
                            <input name="name" type="text" class="form-control" id="exampleFormControlInput1" placeholder="nama permission">
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
@section('footer')
    <script>
        $(document).ready(function () {
            $('#datatable').DataTable();

            $('.delete').click(function () {
                var permis_id = $(this).attr('permission-id');
                swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this data!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            swal("Poof! Your data has been deleted!", {
                                icon: "success",
                            });
                            window.location = "/permission/"+permis_id+"/delete";
                        } else {
                            swal("Your data is safe!");
                        }
                    });
            });
        })
    </script>

@stop



