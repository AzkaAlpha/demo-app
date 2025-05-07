<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<style type="text/css">
    body {
        font-family: 'Arial', sans-serif;
        font-size: 9pt;
        color: #333;
        margin-top: 0px;
        position: relative;
        min-height: 100vh;
    }

    @media print {
        @page {
            width: 21cm;
            height: 33cm;
        }
    }

    @page {
            size: 21cm 33cm; 
            margin-bottom: 100px;
    }

    .page-break {
        page-break-after: always;
        clear: both;
    }

    .content-wrapper {
        position: relative;
        min-height: calc(100vh - 100px);
        padding-bottom: 100px;
    }

    .sticky-footer {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            border-top: 1px solid #ddd;
            background-color: white;
            padding: 5px 0;
    }

    .qr-code {
        float: left;
        width: 50px;
        height: 50px;
        margin: 0 10px;
    }

    .footer-text {
        float: left;
        font-size: 7pt;
        color: #666;
        margin: 0 10px;
    }

    .clearfix::after {
        content: "";
        clear: both;
        display: table;
    }

    .header {
        margin-bottom: 20px;
    }

    h1 {
        margin: 20px 0;
        font-size: 14pt;
    }

    .info-table {
        width: 100%;
        margin: 20px 0;
    }

    .info-table td {
        padding: 2px;
    }

    .info-table td:first-child {
        width: 90px;
    }

    .info-table td:nth-child(2) {
        width: 20px;
        text-align: center;
    }

    .order-table {
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
        page-break-inside: auto;
    }

    .order-table tr {
        page-break-inside: avoid;
        page-break-after: auto;
    }

    .order-table thead {
        display: table-header-group;
    }

    .order-table tbody {
        display: table-row-group;
    }

    .order-table th {
        background-color: #f2f2f2;
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
        font-weight: bold;
    }

    .order-table td {
        border: 1px solid #ddd;
        padding: 8px;
    }

    .order-table tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    .table-container {
        page-break-inside: auto;
    }

    .signature-table {
        width: 100%;
        font-size: 7pt;
        border: 1px solid #000;
        page-break-inside: avoid;
    }

    .signature-table td {
        text-align: center;
        width: 50%;
    }

    .signature-box {
        border: 2px solid #000;
        padding-top: 5px;
        width: 260px;
        text-align: center;
        margin: auto;
    }

    .signature-content {
        display: inline-block;
        vertical-align: middle;
        padding: 0px;
    }

    .signature-logo {
        width: 50px;
        display: inline-block;
        vertical-align: middle;
        padding: 0px;
    }

    .signature-info {
        width: 180px;
        display: inline-block;
        vertical-align: middle;
        padding: 0px;
    }

    .signature-text {
        margin: 0;
        font-size: 6pt;
        padding-top: 0px;
    }

    .signature-name {
        margin: 0;
        padding-top: 0px;
    }

    .signature-nip {
        margin: 0;
        padding-top: 0px;
        text-decoration: overline;
    }
</style>

<body>
    <div class="content-wrapper">
        <div class="header">
            <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('kop/kop-harapan-baru.png'))) }}" width="100%">
        </div>
      
        <h1 style="text-align: center;">Surat Pesanan Barang</h1>

        <table class="info-table">
            <tr>
                <td>Nomor Order</td>
                <td>:</td>
                <td>{{ $order->order_number }}</td>
            </tr>
            <tr>
                <td>Tanggal Order</td>
                <td>:</td>
                <td>{{ \Carbon\Carbon::parse($order->created_at)->locale('id')->isoFormat('D MMMM Y') }}</td>
            </tr>
            <tr>
                <td>Nama Pemohon</td>
                <td>:</td>
                <td>{{ $order->user->name }}</td>
            </tr>
            <tr>
                <td>Cluster</td>
                <td>:</td>
                <td>{{ $order->user->division->name }}</td>
            </tr>
        </table>

        <p>Dengan ini kami sampaikan permintaan barang sebagai berikut :</p>

        <div class="table-container">
            @php
                $items = $order->items;
                $totalItems = $items->count();
                $itemsPerPage = 15;
                $totalPages = ceil($totalItems / $itemsPerPage);
            @endphp

            @for($page = 0; $page < $totalPages; $page++)
                <table class="order-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th>Deskripsi</th>
                            <th>Jumlah</th>
                            <th>Satuan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for($i = 0; $i < $itemsPerPage; $i++)
                            @php
                                $index = ($page * $itemsPerPage) + $i;
                            @endphp
                            @if($index < $totalItems)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $items[$index]->name }}</td>
                                    <td>{{ $items[$index]->description }}</td>
                                    <td>{{ $items[$index]->quantity }}</td>
                                    <td>{{ $items[$index]->unit }}</td>
                                </tr>
                            @endif
                        @endfor
                    </tbody>
                </table>
                @if($page < $totalPages - 1)
                    <div class="page-break"></div>
                @endif
            @endfor
        </div>

        <p>Demikian permintaan kami, atas perhatiannya kami ucapkan terima kasih.</p>

        <table class="signature-table">
            <tr>
                <td>
                    <p>Bendahara</p>
                    <div class="signature-box">
                        <div class="signature-logo">
                            <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logo/pemkot.png'))) }}" alt="" style="width: 40px; padding: 0px;">
                        </div>
                        <div class="signature-info">
                            <p class="signature-text">Ditandatangani secara elektronik oleh :</p><br>
                            <p class="signature-name">{{ $order->verifiedOrder->name }}</p>
                            <p class="signature-nip">{{ $order->verifiedOrder->nip }}</p>
                        </div>
                    </div>
                </td>
                <td>
                    <p>PJ Manager</p>
                    <div class="signature-box">
                        <div class="signature-logo">
                            <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logo/pemkot.png'))) }}" alt="" style="width: 40px; padding: 0px;">
                        </div>
                        <div class="signature-info">
                            <p class="signature-text">Ditandatangani secara elektronik oleh :</p><br>
                            <p class="signature-name">{{ $order->approvedOrder->name }}</p>
                            <p class="signature-nip">{{ $order->approvedOrder->nip }}</p>
                        </div>
                    </div>
                </td>
            </tr>
        </table>
    </div>

    <div class="sticky-footer clearfix">
        <div class="qr-code">
            <img src="data:image/png;base64,{{ base64_encode(QrCode::format('png')
                ->size(50)
                ->generate('Order: ' . $order->order_number . ' | Date: ' . $order->created_at)) }}" 
                alt="QR Code">
        </div>
        <div class="footer-text">
            <p style="margin: 0; padding: 0;">Dokumen ini telah ditandatangani secara elektronik</p>
            <p style="margin: 0; padding: 0;">Scan QR Code untuk verifikasi keaslian dokumen</p>
            <p style="margin: 0; padding: 0;">Nomor Order: {{ $order->order_number }}</p>
            <p style="margin: 0; padding: 0;">Tanggal: {{ \Carbon\Carbon::parse($order->created_at)->locale('id')->isoFormat('D MMMM Y') }}</p>
        </div>
    </div>
</body>
</html>