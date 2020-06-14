<!-- plugins:js -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
{{--<script src="{{asset('assets/vendors/js/vendor.bundle.base.js')}}"></script>--}}

<!-- endinject -->
<!-- Plugin js for this page -->
{{--<script src="{{asset('assets/vendors/chart.js/Chart.min.js')}}"></script>--}}
<script src="{{asset('assets/vendors/jquery-validation/jquery.validate.min.js')}}"></script>
<script src="{{asset('assets/vendors/bootstrap-maxlength/bootstrap-maxlength.min.js')}}"></script>
<script src="{{asset('assets/vendors/summernote/dist/summernote-bs4.min.js')}}"></script>
<script src="{{asset('assets/vendors/tinymce/tinymce.min.js')}}"></script>
<script src="{{asset('assets/vendors/quill/quill.min.js')}}"></script>
<script src="{{asset('assets/vendors/simplemde/simplemde.min.js')}}"></script>
<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="{{asset('assets/js/off-canvas.js')}}"></script>
<script src="{{asset('assets/js/hoverable-collapse.js')}}"></script>
<script src="{{asset('assets/js/misc.js')}}"></script>
<!-- endinject -->
<!-- Custom js for this page -->
{{--<script src="{{asset('assets/js/dashboard.js')}}"></script>--}}
<script src="{{asset('assets/js/todolist.js')}}"></script>
<script src="{{asset('assets/js/file-upload.js')}}"></script>
<script src="{{asset('assets/js/form-validation.js')}}"></script>
<script src="{{asset('assets/js/bt-maxLength.js')}}"></script>
<script src="{{asset('assets/js/editordemo.js')}}"></script>

{{--<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

{{--<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>--}}
<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>

<!-- End custom js for this page -->
<!-- Sweet Alert -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script src="https://cdn.ckeditor.com/4.13.0/full/ckeditor.js"></script>

<!--Select 2-->
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>



<script>
	$(document).ready(function() {
        $('#example').DataTable();
        // $('#example10').DataTable();
        // $('#example9').DataTable();
    } );

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.toggle-class').change(function() {
        var status = $(this).prop('checked') == true ? 1 : 0; 
        var id = $(this).data('id'); 
        var table = $(this).data('table');

        $.ajax({
            type: "POST",
            dataType: "json",
            url: '{{url(route('changeStatus'))}}',
            data: {'status': status, 'id': id, 'table': table},
            success: function(data){
              console.log(data.success)
            }
        });
    })

    $(document).ready(function() {
    	$(document).on('click', '.alerts', function(e){
            var url = $(this).data("url");
            var id = $(this).data("id");
            var table = '.' + $(this).data('table');
            var thisClick = $(this).parents('tr');
            e.preventDefault();
            console.log(url);
            swal({
                title: "{{trans('admin.sure')}}",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })

            .then((willDelete) => {
                if (willDelete) {
                    swal("{{trans('admin.will delete')}}", {
                        icon: "success",
                    });
                    $.ajax({
                        type: 'DELETE',
                        url: url+id,
                        data: {id: id},
                        success:function(data){
                            // location.reload();
                            var datatable = $(table).DataTable();
                            datatable.row(thisClick).remove().draw();
                        }
                    });
                } else {
                    swal("{{trans('admin.not delete')}}");
                }
            });
        });

        CKEDITOR.replace( 'articleContentEN', {
			filebrowserUploadUrl: '{{ route('upload', ['_token' => csrf_token() ]) }}',
            filebrowserUploadMethod: 'form'
		});
        CKEDITOR.replace( 'articleContentAR', {
			filebrowserUploadUrl: '{{ route('upload', ['_token' => csrf_token() ]) }}',
            filebrowserUploadMethod: 'form'
		});
    });
</script>