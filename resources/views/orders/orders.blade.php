@extends('layouts.master')
@section('title')
    قائمة المنتاجات
@stop
@section('css')

    <!-- Internal Data table css -->
    <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!--Internal   Notify -->
    <link href="{{ URL::asset('assets/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />

@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الاوردارات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ قائمة
                    الاوردارات</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')

@if (session()->has('add'))
<script>
    window.onload = function() {
        notif({
            msg: "تم اضافة المنتج بنجاح",
            type: "success"
        })
    }
</script>
@endif

@if (session()->has('delete'))
        <script>
            window.onload = function() {
                notif({
                    msg: "تم حذف المنتج بنجاح",
                    type: "success"
                })
            }
        </script>
    @endif



    <!-- row -->
    <div class="row">




        <!--div-->


        <!--div-->
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-header pb-0">



                         {{-- <a class="modal-effect btn btn-sm btn-primary" href="{{ url('export_invoices') }}"
                        style="color:white"><i class="fas fa-file-download"></i>&nbsp;تصدير اكسيل</a> --}}

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example1" class="table key-buttons text-md-nowrap" data-page-length='50'>
                                <thead>
                                    <tr>
                                        <th class="border-bottom-0">رقم الاوردر</th>
                                        <th class="border-bottom-0">اسم العميل </th>
                                        <th class="border-bottom-0">عنوان العميل</th>
                                        <th class="border-bottom-0"> تليفون العميل</th>
                                        <th class="border-bottom-0"> ايميل العميل</th>
                                        <th class="border-bottom-0"> تفاصيل الاوردر</th>
                                        <th class="border-bottom-0">تاريخ الطلب</th>
                                        <th class="border-bottom-0">حالة الاوردر</th>

                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($orders as $order)
                                        @if ($order->status == 'delivered')
                                        <tr style="background-color: #b3ffb3">
                                        @elseif ($order->status == 'Indelivery')
                                        <tr style="background-color: #d1d1e0">
                                        @else
                                        <tr>
                                        @endif

                                            <td>{{$order->id}}</td>
                                            <td>{{$order->first_name}} {{$order->last_name}}</td>
                                            <td>{{$order->address}}, {{$order->city}}, {{$order->postcode}}</td>
                                            <td>{{$order->phone}}</td>
                                            <td>{{$order->email}}</td>
                                            <td>
                                            <ul>
                                            @foreach ($products as $key => $product )
                                                <li>
                                                    {{$products[$key][0]['Product_name']}} - {{$products[$key][0]['size']}} - {{$products[$key][0]['price']}} - {{$products[$key][0]['brand']}} - {{$products[$key][0]['color']}}

                                                </li>
                                            @endforeach
                                            </ul>
                                        </td>

                                            <td>{{$order->created_at}}</td>


                                            <td>
                                                <div class="dropdown">

                                                    <button aria-expanded="false" aria-haspopup="true"
                                                        class="btn ripple btn-primary btn-sm" data-toggle="dropdown"
                                                        type="button">{{$order->status}}<i
                                                            class="fas fa-caret-down ml-1"></i></button>
                                                    <div class="dropdown-menu tx-13">

                                                        @if ($order->status != 'pending')
                                                        <a class="dropdown-item"
                                                            href="/change_status/pending/{{$order->id}}">Pending</a>
                                                        @endif

                                                        @if ($order->status != 'Indelivery')
                                                        <a class="dropdown-item"
                                                            href="/change_status/Indelivery/{{$order->id}}" style="color: gray">In delivery </a>
                                                        @endif

                                                        @if ($order->status != 'delivered')
                                                        <a class="dropdown-item"
                                                            href="/change_status/delivered/{{$order->id}}" style="color: green">delivered</a>
                                                        @endif


                                                    </div>
                                                </div>

                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!--/div-->


        </div>

        <!-- حذف الفاتورة -->
        <div class="modal fade" id="delete_invoice" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">حذف الفاتورة</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <form action="{{ route('products.destroy','destroy') }}" method="post">
                            {{ method_field('delete') }}
                            {{ csrf_field() }}
                    </div>
                    <div class="modal-body">
                        هل انت متاكد من عملية الحذف ؟
                        <input type="hidden" name="product_id" id="product_id" value="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                        <button type="submit" class="btn btn-danger">تاكيد</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

            <!-- ارشيف الفاتورة -->
    <div class="modal fade" id="Transfer_invoice" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">ارشفة الفاتورة</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                {{-- <form action="{{ route('invoices.destroy', 'test') }}" method="post">
                    {{ method_field('delete') }}
                    {{ csrf_field() }}
            </div>
            <div class="modal-body">
                هل انت متاكد من عملية الارشفة ؟
                <input type="hidden" name="invoice_id" id="invoice_id" value="">
                <input type="hidden" name="id_page" id="id_page" value="2">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                <button type="submit" class="btn btn-success">تاكيد</button>
            </div>
            </form> --}}
        </div>
    </div>
</div>

    </div>
    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!-- Internal Data tables -->
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
    <!--Internal  Datatable js -->
    <script src="{{ URL::asset('assets/js/table-data.js') }}"></script>
        <!--Internal  Notify js -->
        <script src="{{ URL::asset('assets/plugins/notify/js/notifIt.js') }}"></script>
        <script src="{{ URL::asset('assets/plugins/notify/js/notifit-custom.js') }}"></script>

    <script>
        $('#delete_invoice').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var product_id = button.data('product_id')
            var modal = $(this)
            modal.find('.modal-body #product_id').val(product_id);
        })
    </script>

<script>
    $('#Transfer_invoice').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var invoice_id = button.data('invoice_id')
        var modal = $(this)
        modal.find('.modal-body #invoice_id').val(invoice_id);
    })
</script>
@endsection
