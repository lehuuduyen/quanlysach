@extends('layouts.app')

@section('content')
    <div class="col-md-3">

        <div class="card ">
            <form id="form_add_book" method="post" enctype="multipart/form-data">
                <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                    <div class="fileinput-new thumbnail img-raised">
                        <img id="image" src="http://www.psdgraphics.com/file/blank-white-book.jpg"
                             alt="...">
                    </div>
                    <div class="fileinput-preview fileinput-exists thumbnail img-raised"></div>
                    <div>
                            <span class="btn btn-raised btn-round btn-rose btn-file">
                               <span class="fileinput-new">Select image</span>
                               <span class="fileinput-exists">Change</span>
                               <input type="file" id="file"  name="image"/>
                            </span>
                        <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput">
                            <i class="fa fa-times"></i> Remove</a>
                    </div>
                </div>

                <div class="card-body ">
                    <div class="form-group bmd-form-group">
                        <label for="title" class="bmd-label-floating"> Title</label>
                        <input type="text"  class="form-control" id="title" aria-
                               name="title"
                               autocomplete="off">
                    </div>
                    <div class="form-group bmd-form-group">
                        <label for="author" class="bmd-label-floating"> Author</label>
                        <input type="text"  class="form-control" id="author" name="author"
                               autocomplete="off">
                    </div>
                    <div class="form-group bmd-form-group">
                        <label for="content" class="bmd-label-floating"> Content</label>
                        <input type="text"  class="form-control" id="content" name="content"
                               autocomplete="off">
                    </div>


                    <div class="form-group bmd-form-group is-filled">
                        <label class="bmd-label-floating"> Description.</label>
                        <textarea name="description"  id="description" class="form-control" rows="5"></textarea>
                    </div>
                    <select class="selectpicker mb-3 "  name="status" id="status" data-style="btn  btn-round"
                            title="Single Select">
                        <option  selected value=" ">Single Option</option>
                        <option value="0">Out of stock</option>
                        <option value="1">Stocking</option>
                    </select>
                    <a class="btn btn-primary btn-lg mx-auto" id="vote-a" style="display: none !important;" data-toggle="modal" data-target="#vote" data-original-title>
                        Vote Now!
                    </a>



                </div>
            </form>

        </div>
    </div>

    <div class="col-md-9">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="tableData">
                        <thead class=" text-primary">
                        <th field="image">
                            Image
                        </th>
                        <th field="author">
                            Author
                        </th>
                        <th field="title">
                            Title
                        </th>
                        <th field="content">
                            Content
                        </th>
                        <th field="sum">
                            Sum
                        </th>
                        <th field="status">
                            Status
                        </th>
                        <th field="action">
                            Action
                        </th>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="vote" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Vote Book: <span id="modal_title"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form-vote">
                    <input type="hidden" name="book_id" id="id">
                    <div class="modal-body">

                        <div class="col">

                            @for($i=1;$i<=10;$i++)
                                <label class="form-check-label mr-5">
                                    <input class="form-check-input" style="cursor:pointer" type="radio" name="rate"
                                           value="{{$i}}">
                                    {{$i}}
                                </label>
                            @endfor

                        </div>

                    </div>
                </form>
                <div class="modal-footer">
                    <button type="button" onclick="btn_vote()" class="btn btn-primary" >Save Vote</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection



@section('footer')
    <script>
        function jsUcfirst(string) {
            return string.charAt(0).toUpperCase() + string.slice(1);
        }
        //datatable
        fields = [];
        var $tableData = $('#tableData > thead > tr > th').each(function () {
            var value = $(this).attr('field');
            fields.push({data: value, name: value});
        }).promise().done(function () {
            datatables = $('#tableData').DataTable({
                processing: true,
                serverSide: true,
                "aLengthMenu": [[5, 50, 75, -1], [5, 50, 75, "All"]],
                "iDisplayLength": 5,
                ajax: {
                    url: "{{url('api/book/list')}}",
                    //                    data: function (d) {
                    //
                    //                        d.data = request;
                    //                    }
                },
                order:
                    [[0, 'desc']],
                // dom: 'Bfrtip',
                // buttons: [
                //
                //     'copy', 'csv', 'excel', 'pdf', 'print'
                //
                // ],
                "columnDefs": [{
                    "targets": -1,
                    "data": null,
                    render: function (data, type, full, meta) {
                        return '<button class="btn btn-primary" onclick="detail(' + full.id + ')">Edit!</button>';
                    },
                }],
                columns: fields
            });
        });
        $("#form_add_book").submit(function (e) {
            e.preventDefault();
            var str = $('#form_add_book').serialize()
            var array = str.split('&');
            var str_error = '';
            var formData = new FormData(this);
            var file = $('#file')[0].files[0];
            if (!array[4]) {
                array[4] = "status=";
            }
            $.each(array, function (k, v) {
                var array_check = v.split('=');
                if (array_check[1] == "") {
                    str_error += jsUcfirst(array_check[0]) + " không được để trống <br>";
                }
            })
            if (file == null) {
                str_error += "Imgae không được để trống";
            }
            if (str_error == '') {
                $.ajax({
                    url: "{{url('api/book/store')}}",
                    type: 'POST',
                    data: formData,
                    success: function (data) {
                        swal("Good job!", data.message, "success");
                        $("#status").val(" ");
                        $('#status').selectpicker('refresh')
                        document.getElementById("form_add_book").reset();
                        $('#tableData').DataTable().ajax.reload();
                    },
                    cache: false,
                    contentType: false,
                    processData: false
                });
            } else {
                swal("Not Empty!", str_error, "error");
            }
        })
        function detail(id) {
            $.ajax({
                url: "{{url('api/book/show')}}/" + id,
                type: 'GET',
                success: function (kq) {
                    $("#vote-a").css('display','block')
                    $("#file").attr('disabled','disabled');
                    var data = kq.data;
                    $.each(data, function (k, v) {
                        if(k!='id'){
                            $("#" + k).attr('disabled','disabled');
                        }
                        $("#" + k).val(v);
                        $("#" + k).parent('div').addClass('is-filled');
                        if (k == 'status') {
                            var str = 'Out of stock';
                            if (v == 1) {
                                str = 'Stocking';
                            }
                            $('.bootstrap-select .filter-option').text(str);
                        }
                        if (k == 'image') {
                            $("#image").attr('src', "{{url('')}}" + v)
                        }
                        if (k == 'title') {
                            $("#modal_title").text(v)
                        }
                    })
                },
            });
        }
        function btn_vote(){
            var rate=$("input[name='rate']:checked").val();
            console.log(rate)
            if(rate!=null){

                $.ajax({
                    url: "{{url('api/book/vote')}}" ,
                    type: 'post',
                    data:$('#form-vote').serialize(),
                    success: function (kq) {
                        swal("Good job!", kq.message, "success");
                        document.getElementById("form-vote").reset();
                        document.getElementById("form_add_book").reset();
                        $('#tableData').DataTable().ajax.reload();

                        $("#vote-a").css('display','none')
                        $("#vote").modal('hide')

                        var data = kq.data;
                        $.each(data, function (k, v) {
                            console.log(k)
                            $("#" + k).removeAttr('disabled');
                            $("#file").removeAttr('disabled');
                        })
                    },
                });
            }
            else{
                swal("Error!","Not Empty", "error");

            }
        }
    </script>

@endsection
