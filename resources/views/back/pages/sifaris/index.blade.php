@extends('back.layout.master')

@section('title') Sifarişlər  @endsection
@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css">

    <style>
        table tr td {
            width: max-content !important;
        }

        table.dataTable {
            margin: 0 0 !important;
        }

        .card {
            word-wrap: normal;
        }


        .dt-buttons {
            margin-left: 35%;
            margin-top: 15px;
        }

        .buttons-excel,.buttons-print {
            background-color:
                #232e3c;
        }

        table.dataTable tbody tr, .dataTables_length select {
            background-color:
                #232e3c !important;
        }

        table.theme-dark tr td{
            color:
                #FFFFFF;
        }

        .table-mobile-md td {
            color:
                #FFFFFF !important;
        }

        #products_info {
            color:
                #FFFFFF !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button           {
            color:
                #FFFFFF !important;
        }

        .page-item, .paginate_button,#products_length,#products_filter,#products_paginate,a.paginate_button {
            color:
                #FFFFFF !important;
        }

        .text-wrap{
            white-space:normal;
        }
        .width-200{
            width:400px;
        }

    </style>
@endsection

@section('content')
    @include('back.includes.add-image')
    <div class="page">
        @include('back.includes.menu')

        <div class="content">
            <div class="mb-3 table-responsive" style="padding: 0 10px !important;">
                <table class="table table-vcenter table-mobile-md card-table" style="width: 100% !important;" id="products">
                    <thead>
                    <tr>
                        <th>Ad,Soyad</th>
                        <th>Ünvan</th>
                        <th>Poçt Kodu</th>
                        <th>Email</th>
                        <th>Telefon</th>
                        <th>Elavə şərh</th>
                        <th>Info</th>
                        <th>Tarix</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody style="width: 100% !important;">

                    </tbody>
                </table>
            </div>
        </div>
        @include('back.includes.footer')
    </div>
@endsection

@section('js')
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4-4.1.1/jq-3.3.1/jszip-2.5.0/dt-1.10.21/b-1.6.2/b-html5-1.6.2/b-print-1.6.2/datatables.min.js"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var table = $('#products');
        getProducts(table);

        function getProducts(table) {
            table.DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('sifaris.index') }}",
                },
                columns: [
                    {data: 'ad_soyad', name: 'ad_soyad'},
                    {data: 'unvan', name: 'unvan'},
                    {data: 'poct_kodu', name: 'poct_kodu'},
                    {data: 'email', name: 'email'},
                    {data: 'telefon', name: 'telefon'},
                    {data: 'elave_serh', name: 'elave_serh'},
                    {data: 'info', name: 'info'},
                    {
                        name: 'created_at.timestamp',
                        data: {
                            _: 'created_at.display',
                            sort: 'created_at.timestamp'
                        }
                    },
                    {data: 'action', name: 'action'}
                ],
                createdRow: function( row, data, dataIndex ) {
                    $( row ).find('td:eq(0)').attr('data-label', "Ad,Soyad");
                    $( row ).find('td:eq(1)').attr('data-label', "Ünvan");
                    $( row ).find('td:eq(2)').attr('data-label', 'Poçt Kodu');
                    $( row ).find('td:eq(3)').attr('data-label', 'Email');
                    $( row ).find('td:eq(4)').attr('data-label', 'Telefon');
                    $( row ).find('td:eq(5)').attr('data-label', 'Elavə şərh');
                    $( row ).find('td:eq(6)').attr('data-label', 'Info');
                    $( row ).find('td:eq(7)').attr('data-label', 'Tarix');
                    $( row ).find('td:eq(8)').attr('data-label', 'Action');
                },
                columnDefs: [
                    {
                        render: function (data, type, full, meta) {
                            return "<div class='text-wrap width-200'>" + data + "</div>";
                        },
                        targets: 5
                    },
                    {
                        targets: 6, searchable: false, orderable: false,
                    }
                ],
                "language": {
                    "emptyTable": "Cədvəldə heç bir məlumat yoxdur",
                    "infoEmpty": "Nəticə Yoxdur",
                    "infoFiltered": "( _MAX_ Nəticə İçindən Tapılanlar)",
                    "lengthMenu": "Səhifədə _MENU_ Nəticə Göstər",
                    "loadingRecords": "Yüklənir...",
                    "processing": "Gözləyin...",
                    "search": "Axtarış:",
                    "zeroRecords": "Nəticə Tapılmadı.",
                    "paginate": {
                        "first": "İlk",
                        "last": "Axırıncı",
                        "previous": "Öncəki",
                        "next": "Sonrakı"
                    },
                    "aria": {
                        "sortDescending": ": sütunu azalma sırası üzərə aktiv etmək",
                        "sortAscending": ": sütunu artma sırası üzərə aktiv etməkr"
                    },
                    "autoFill": {
                        "cancel": "Ləğv Et",
                        "fill": "Bütün hücrələri <i>%d<\/i> ile doldur",
                        "fillHorizontal": "Hücrələri üfiqi olaraq doldur",
                        "fillVertical": "Hücrələri şaquli olara1 doldur"
                    },
                    "buttons": {
                        "collection": "Kolleksiya <span class=\"\\\"><\/span>",
                        "colvis": "Sütun baxışı",
                        "colvisRestore": "Baxışı əvvəlki vəziyyətinə gətir",
                        "copy": "Kopyala",
                        "copyKeys": "Cədvəldəki qeydi kopyalamaq üçün CTRL və ya u2318 + C düymələrinə basın. Ləğv etmək üçün bu mesajı vurun və ya ESC düyməsini vurun.",
                        "copySuccess": {
                            "1": "1 sətir panoya kopyalandı",
                            "_": "%ds sətir panoya kopyalandı"
                        },
                        "copyTitle": "Panoya kopyala",
                        "csv": "CSV",
                        "excel": "Excel",
                        "pageLength": {
                            "-1": "Bütün sətirlari göstər",
                            "_": "%d sətir göstər"
                        },
                        "pdf": "PDF",
                        "print": "Çap Et"
                    },
                    "decimal": ",",
                    "info": "_TOTAL_ Nəticədən _START_ - _END_ Arası Nəticələr",
                    "infoThousands": ".",
                    "searchBuilder": {
                        "add": "Koşul Ekle",
                        "button": {
                            "0": "Axtarış Yaradıcı",
                            "_": "Axtarış Yaradıcı (%d)"
                        },
                        "clearAll": "Filtrləri Təmizlə",
                        "condition": "Şərt",
                        "conditions": {
                            "date": {
                                "after": "Növbəti",
                                "before": "Öncəki",
                                "between": "Arasında",
                                "empty": "Boş",
                                "equals": "Bərabərdir",
                                "not": "Deyildir",
                                "notBetween": "Xaricində",
                                "notEmpty": "Dolu"
                            },
                            "number": {
                                "between": "Arasında",
                                "empty": "Boş",
                                "equals": "Bərabərdir",
                                "gt": "Böyükdür",
                                "gte": "Böyük bərabərdir",
                                "lt": "Kiçikdir",
                                "lte": "Kiçik bərabərdir",
                                "not": "Deyildir",
                                "notBetween": "Xaricində",
                                "notEmpty": "Dolu"
                            },
                            "string": {
                                "contains": "Tərkibində",
                                "empty": "Boş",
                                "endsWith": "İlə bitər",
                                "equals": "Bərabərdir",
                                "not": "Deyildir",
                                "notEmpty": "Dolu",
                                "startsWith": "İlə başlayar"
                            },
                            "array": {
                                "equals": "Bərabərdir",
                                "empty": "Boş",
                                "contains": "Tərkibində",
                                "not": "Deyildir",
                                "notEmpty": "Dolu",
                                "without": "Xaric"
                            }
                        },
                        "data": "Qeyd",
                        "deleteTitle": "Filtrləmə qaydasını silin",
                        "leftTitle": "Meyarı xaricə çıxarmaq",
                        "logicAnd": "və",
                        "logicOr": "vəya",
                        "rightTitle": "Meyarı içəri al",
                        "title": {
                            "0": "Axtarış Yaradıcı",
                            "_": "Axtarış Yaradıcı (%d)"
                        },
                        "value": "Değer"
                    },
                    "searchPanes": {
                        "clearMessage": "Hamısını Təmizlə",
                        "collapse": {
                            "0": "Axtarış Bölməsi",
                            "_": "Axtarış Bölməsi (%d)"
                        },
                        "count": "{total}",
                        "countFiltered": "{shown}\/{total}",
                        "emptyPanes": "Axtarış Bölməsi yoxdur",
                        "loadMessage": "Axtarış Bölməsi yüklənir ...",
                        "title": "Aktiv filtrlər - %d"
                    },
                    "select": {
                        "cells": {
                            "1": "1 hücrə seçildi",
                            "_": "%d hücrə seçildi"
                        },
                        "columns": {
                            "1": "1 sütun seçildi",
                            "_": "%d sütun seçildi"
                        },
                        "rows": {
                            "1": "1 qeyd seçildi",
                            "_": "%d qeyd seçildi"
                        }
                    },
                    "thousands": ".",
                    "datetime": {
                        "previous": "Öncəki",
                        "next": "Növbəti",
                        "hours": "Saat",
                        "minutes": "Dəqiqə",
                        "seconds": "Saniyə",
                        "unknown": "Naməlum",
                        "amPm": [
                            "am",
                            "pm"
                        ]
                    },
                    "editor": {
                        "close": "Bağla",
                        "create": {
                            "button": "Təzə",
                            "title": "Yeni qeyd yarat",
                            "submit": "Qeyd Et"
                        },
                        "edit": {
                            "button": "Redaktə Et",
                            "title": "Qeydi Redaktə Et",
                            "submit": "Yeniləyin"
                        },
                        "remove": {
                            "button": "Sil",
                            "title": "Qeydləri sil",
                            "submit": "Sil",
                            "confirm": {
                                "_": "%d ədəd qeydi silmək istədiyinizə əminsiniz?",
                                "1": "Bu qeydi silmək istədiyinizə əminsiniz?"
                            }
                        },
                        "error": {
                            "system": "Sistem xətası baş verdi (Ətraflı Məlumat)"
                        },
                        "multi": {
                            "title": "Çox dəyər",
                            "info": "Seçilmiş qeydlər bu sahədə fərqli dəyərlər ehtiva edir. Bütün seçilmiş qeydlər üçün bu sahəyə eyni dəyəri təyin etmək üçün buraya vurun; əks halda hər qeyd öz dəyərini saxlayacaqdır.",
                            "restore": "Dəyişiklikləri geri qaytarın",
                            "noMulti": "Bu sahə qrup şəklində deyil, ayrı-ayrılıqda təşkil edilə bilər."
                        }
                    }
                } ,
                stateSave: true,
            });
        }
    </script>

    <script>
        $(document).on('click', '.messageDeleter', function () {
            var id = $(this).data('id');
            var table = $('#products');
            $.ajax({
                url: '/admin/contact/' + id,
                type: 'DELETE',
                data: {
                    '_token': '{{ csrf_token() }}'
                },
                success: function (result) {
                    toastr.success('result.message');
                    table.dataTable().fnDestroy();
                    getProducts(table)
                }
            });
        });

        $(document).on('click','.badge', function () {
            let id = $(this).attr('data-id');
            $.ajax({
                url: '{!! route('back.switcher') !!}',
                type: 'POST',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'id': id
                },
                success: function (result) {
                    toastr.success('Status dəyişdirildi');
                    table.dataTable().fnDestroy();
                    getProducts(table)
                }
            })
        });
    </script>

    <script>
        $(function() {
            // Multiple images preview in browser
            var imagesPreview = function(input, placeToInsertImagePreview) {

                if (input.files) {
                    var filesAmount = input.files.length;

                    for (i = 0; i < filesAmount; i++) {
                        var reader = new FileReader();

                        reader.onload = function(event) {
                            $($.parseHTML('<img>')).attr({
                                'src' : event.target.result,
                                'witth' : '60px',
                                'height' : '60px',
                            }).css({
                                'margin' : '10px'
                            }).appendTo(placeToInsertImagePreview);
                        }

                        reader.readAsDataURL(input.files[i]);
                    }
                }

            };

            $('#pImage').on('change', function() {
                imagesPreview(this, 'div.gallery');

                var property = document.getElementById('photo-form');
                var form_data = new FormData(property);
                $.ajax({
                    type : 'POST',
                    data : form_data,
                    url  : '{!! route('back.photo.save') !!}',
                    cache: false,
                    processData: false,
                    contentType: false,
                    success : function () {
                        toastr.success('Profil şəkili uğurla əlavə edildi');
                        $('.closeBtn').click();
                        table.dataTable().fnDestroy();
                        getProducts(table);
                    },
                    error : function (myErrors) {
                        $.each(myErrors.responseJSON.errors,function (key, value) {
                            toastr.error(value,'Xəta');
                        });
                    }
                });
            });
        });

        $(document).on('click', '.imageModal', function () {
            $('.gallery').html('');
            let product_id = $(this).attr('data-id');
            $('#product_id').val(product_id);
            $.ajax({
                type : 'POST',
                url  : '{!! route('back.old.photos') !!}',
                data : {
                    product_id : product_id
                },
                success : function (response) {
                    let output = '';
                    $.each(response.images, function (key, item) {
                        output += '<img src="{!! asset('files/products/') !!}/'+item.src+'" data-id="'+item.id+'" class="imageDeleter" width="60px" height="60px" style="margin: 10px">';
                    });
                    $('.gallery').html(output);
                }
            });
        });

        $(document).on('dblclick', '.imageDeleter', function () {
            let image_id = $(this).attr('data-id');
            $('#image_id').val(image_id);
            $('#imageDeleteBtn').click();
        });
    </script>
@endsection
