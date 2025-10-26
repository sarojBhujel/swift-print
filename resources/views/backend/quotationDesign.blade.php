<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <style>
        #invoice {
            padding: 30px;
        }

        ​ .invoice {
            position: relative;
            background-color: #fff;
            min-height: 680px;
            padding: 15px;
        }

        ​ .invoice header {
            padding: 10px 0;
            margin-bottom: 20px;
            /* border-bottom: 1px solid #3989c6; */
        }

        ​

        /* .invoice .company-details {
        text-align: right;
      } */
        ​ .invoice .company-details .name {
            margin-top: 0;
            margin-bottom: 0;
        }

        ​ .invoice .contacts {
            margin-bottom: 20px;
        }

        ​ .invoice .invoice-to {
            text-align: left;
        }

        ​ .invoice .invoice-to .to {
            margin-top: 0;
            margin-bottom: 0;
        }

        ​ .invoice .invoice-details {
            text-align: right;
        }

        ​ .invoice .invoice-details .invoice-id {
            margin-top: 0;
            color: #3989c6;
        }

        ​ .invoice main {
            padding-bottom: 50px;
        }

        ​ .invoice main .thanks {
            margin-top: -100px;
            font-size: 2em;
            margin-bottom: 50px;
        }

        ​ .invoice main .notices {
            padding-left: 6px;
            border-left: 6px solid #3989c6;
        }

        ​ .invoice main .notices .notice {
            font-size: 1.2em;
        }

        ​ .invoice table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 20px;
        }

        ​ .invoice table td,
        .invoice table th {
            padding: 15px;
            background: #eee;
            border-bottom: 1px solid #fff;
        }

        ​ .invoice table th {
            white-space: nowrap;
            font-weight: 400;
            font-size: 16px;
        }

        ​ .invoice table td h3 {
            margin: 0;
            font-weight: 400;
            color: #3989c6;
            font-size: 1.2em;
        }

        ​ .invoice table .qty,
        .invoice table .total,
        .invoice table .unit {
            text-align: right;
            font-size: 1.2em;
        }

        ​ .invoice table .no {
            color: #fff;
            font-size: 1.6em;
            background: #3989c6;
        }

        ​ .invoice table .unit {
            background: #ddd;
        }

        ​ .invoice table .total {
            background: #3989c6;
            color: #fff;
        }

        ​ .invoice table tbody tr:last-child td {
            border: none;
        }

        ​ .invoice table tfoot td {
            background: 0 0;
            border-bottom: none;
            white-space: nowrap;
            text-align: right;
            padding: 10px 20px;
            font-size: 1.2em;
            border-top: 1px solid #aaa;
        }

        ​ .invoice table tfoot tr:first-child td {
            border-top: none;
        }

        ​ .invoice table tfoot tr:last-child td {
            color: #3989c6;
            font-size: 1.4em;
            border-top: 1px solid #3989c6;
        }

        ​ .invoice table tfoot tr td:first-child {
            border: none;
        }

        ​ .invoice footer {
            width: 100%;
            text-align: center;
            color: #777;
            border-top: 1px solid #aaa;
            padding: 8px 0;
        }

        ​ @media print {
            .invoice {
                font-size: 11px !important;
                overflow: hidden !important;
            }

            ​ .invoice footer {
                position: absolute;
                bottom: 10px;
                page-break-after: always;
            }

            ​ .invoice>div:last-child {
                page-break-before: always;
            }
        }

        .cborder-right {
            border-right: 3px solid red;
        }

        .cus-border-bottom {
            border-bottom: 3px solid red;
            font-weight: bold;
        }
        .with-input-background{
            border-bottom: 2px dotted black;
            background-color: #0000ff2b;
        }
        textarea {
            border: none;
            resize: none;
        }

    </style>
</head>

<body>
    {{-- @dd($data,'hete') --}}
    <div class="row">
        <div class="col-6 pl-5">
            <p>Gvt. Reg. No. 95176/060/070</p>
        </div>
        <div class="col-6 pr-5">
            <p class="text-right">Pan No.600654733</p>
        </div>
    </div>
    <div id="invoice">
        

        <div class="invoice overflow-auto">
            <div style="min-width: 600px">
                <header>
                    <div class="row">
                        <div class="col cborder-right">
                                <img src="{{asset('backend/images/epress-logo.png')}}" />
                        </div>
                        <div class="col company-details pl-5">
                            <h5 class="name">

                            </h5>
                            <div>
                                <h5 class="mb-0"><b>P.O.Box:6120,Tel:4107733,9851086094</b></h5>
                            </div>
                            <div>
                                <h5 class="mb-0"><b>Shantinagar,Baneshwor-34, KTM Nepal</b></h5>
                            </div>
                            <div>
                                <h5 class="mb-0"><b>email- info@epress.com.np</b></h5>
                                <h5 class="mb-0"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;epress07@gmail.com</b></h5>  
                            </div>
                            <div>
                                <h5 class="mb-0"><b>Web -www.epress.com.np</b></h5>
                            </div>
                        </div>
                    </div>
                </header>
                <div class="mt-4">
                    <h1 class="text-center" style="color: #3989c6;"><span class="cus-border-bottom ">QUOTATION</span>
                    </h1>
                </div>
                <main>
                    <div class="row">
                        <div class="col-1">
                            <h3> <b>To</b></h3>
                        </div>
                        <div class="col-6">
                            <h3 class=" with-input-background">{{$data['customer_id']}}</h3>
                        </div>
                        <div class="col-2 pr-0">
                            <h3 class="text-right"> <b>Q.No :</b></h3>
                        </div>
                        <div class="col-3 pl-0">
                            <h3 class="text-left with-input-background">{{$data['quotation_no']}}</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-1">
                        </div>
                        <div class="col-6">
                            <h3 class=" with-input-background">{{$data['address']}}</h3>
                        </div>
                        <div class="col-2 pr-0">
                            <h3 class="text-right"> <b>Date :</b></h3>
                        </div>
                        <div class="col-3 pl-0">
                            <h3 class="text-left with-input-background">{{$data['date']}}</h3>
                        </div>
                    </div>
                    <div style="margin-top: 6%;">
                        <h3><b>Dear Sir/Madam</b> </h3>
                    </div>
                    <div>
                        <h3><b>We are Pleased to submit this quotation with our best prices as follows.</b> </h3>
                    </div>
                    <div class="row" style="margin-top: 6%;">
                        <div class="col-3 pr-0">
                            <h4> <b>Name of Job:</b></h4>
                        </div>
                        <div class="col-9 pl-0">
                            <h3 class=" with-input-background text-left">{{$data['job_name']}}</h3>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 1%;">
                        <div class="col-2 pr-0">
                            <h4> <b>Paper:</b></h4>
                        </div>
                        <div class="col-10 pl-0">
                            <h3 class=" with-input-background text-left">{{$data['paper']}} </h3>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 1%;">
                        <div class="col-1 pr-0">
                            <h4> <b>Print:</b></h4>
                        </div>
                        <div class="col-5 px-0">
                            <h3 class=" with-input-background text-left">{{$data['print']}} </h3>
                        </div>
                        <div class="col-1 px-0">
                            <h4> <b>Page:</b></h4>
                        </div>
                        <div class="col-5 px-0">
                            <h3 class=" with-input-background text-left">{{$data['page']}}  </h3>
                        </div>
                    </div>
                    
                    <div class="row" style="margin-top: 1%;">
                        <div class="col-2 pr-0">
                            <h4> <b>Quantity:</b></h4>
                        </div>
                        <div class="col-4 px-0">
                            <h3 class=" with-input-background text-left">{{$data['quantity']}}   </h3>
                        </div>
                        <div class="col-1 px-0">
                            <h4> <b>Size:</b></h4>
                        </div>
                        <div class="col-5 px-0">
                            <h3 class=" with-input-background text-left">{{$data['size']}} </h3>
                        </div>
                        
                    </div>
                    <div class="row" style="margin-top: 1%;">
                        <div class="col-2 pr-0">
                            <h4> <b>lamination:</b></h4>
                        </div>
                        <div class="col-2 px-0">
                            <h3 class=" with-input-background text-left">{{$data['lamination']}} </h3>
                        </div>
                        {{-- <div class="col-1 px-0">
                            <h4> <input type="checkbox" name="" id=""></h4>
                        </div>
                        <div class="col-2 px-0">
                            <h3 class=" with-input-background text-left">@ Glossy</h3>
                        </div>
                        <div class="col-1 px-0">
                            <h4> <input type="checkbox" name="" id=""></h4>
                        </div> --}}
                    </div>
                    
                    <div class="row" style="margin-top: 1%;">
                        <div class="col-2 pr-0">
                            <h4> <b>Binding:</b></h4>
                        </div>
                        <div class="col-4 px-0">
                            <h3 class=" with-input-background text-left">{{$data['binding']}} </h3>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 1%;">
                        <div class="col-2 pr-0">
                            <h4> <b>Rate:</b></h4>
                        </div>
                        <div class="col-4 px-0">
                            <h3 class=" with-input-background text-left">{{$data['rate']}} </h3>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 1%;">
                        
                        <textarea name="" id="rexttyaread"  rows="10" class="col-md-12" style="border: 2px black solid">{{$data['note']}}</textarea>
                    </div>
                </main>
                <div class="row" style="margin-top: 3%;">
                    <div class="col-9 ">
                        <h1><span style="border-top: 3px solid red;">Terms And Conditions</span>
                        </h1>
                        <p class="mb-0"><b>@ Vat 13% Excluded</b></p>
                        <p class="mb-0"><b>@ This Quotation will be Valid for 30 Days only.</b></p>
                        <p class="mb-0"><b>@ Delivery Time Ten Working Days From The Date of Final Approval</b></p>
                    </div>
                    <div class="col-3 text-right">
                        <div style="border-bottom: 3px dotted black;">
                            <img src="{{asset($data['signature'])}}" style="height: 70px;
                            width: 100%;"/>
                        </div>
                        <h2 class=" text-right"><b>{{$data['name']}}</b>  </h2>
                        <h2 class=" text-right"><b>{{$data['position']}}</b>  </h2>
                    </div>
                </div>
            </div>
            <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
            <div></div>
        </div>
    </div>
</body>
<script>
    setTimeout(function() {
        window.print();
    }, 500);
    window.onfocus = function() {
        setTimeout(function() {
            window.close();
        });
    }
</script>

</html>
