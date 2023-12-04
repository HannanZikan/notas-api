<x-mail::message>
    <h1>Nova Nota Fiscal Criada:</h1>
    <br>
    <h2>Detalhes da nota:</h2>
    <ul>
        <li>Número de Identificação: {{ $invoice['order_number'] }}</li>
        <li>Valor :{{ ($invoice['amount'])}}</li>
        <li>Data de envio: {{ $invoice['issue_date'] }}</li>
        <ul>
            <h3>Dados do Remetente</h3>
            <li>CNPJ do Remetente: {{ $invoice['sender_cnpj'] }}</li>
            <li>Nome do Remetente: {{ $invoice['sender_name'] }}</li>
        </ul>
        <ul>
            <h3>Dados do Transportador</h3>
            <li>CNPJ do Transportador: {{ $invoice['carrier_cnpj'] }}</li>
            <li>Nome do Transportador: {{ $invoice['carrier_name'] }}</li>
        </ul>
    </ul>
    <br> Atenciosamente,<br>
    {{ config('app.name') }}
</x-mail::message>
