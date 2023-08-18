<?php

use Carbon\CarbonInterval;
use Illuminate\Support\Carbon;

function decodeStatusOrder(string $status): stdClass
{
    $response = new \stdClass();

    switch ($status) {
        case ORDER_OPEN:
            $response->label = 'Novo Pedido';
            $response->class = 'badge badge-warning';
            break;
        case ORDER_DONE:
            $response->label = 'Finalizado';
            $response->class = 'badge badge-success';
            break;
        case ORDER_REJECTED:
            $response->label = 'Rejeitado';
            $response->class = 'badge badge-secondary';
            break;
        case ORDER_WORKING:
            $response->label = 'Em preparo';
            $response->class = 'badge badge-info';
            break;
        case ORDER_CANCELED:
            $response->label = 'Cancelado';
            $response->class = 'badge badge-danger';
            break;
        case ORDER_DELIVERING:
            $response->label = 'Saiu para Entrega';
            $response->class = 'badge badge-primary';
            break;
        default:
    }

    return $response;
}

function formatMoney($number): string
{
    return "R$ " . number_format($number, 2,',', '.');
}

function formatCnpjCpf($value)
{
    $CPF_LENGTH = 11;
    $cnpj_cpf = preg_replace("/\D/", '', $value);

    if (strlen($cnpj_cpf) === $CPF_LENGTH) {
        return preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "\$1.\$2.\$3-\$4", $cnpj_cpf);
    }

    return preg_replace("/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/", "\$1.\$2.\$3/\$4-\$5", $cnpj_cpf);
}

function telefone($n)
{
    $tam = strlen(preg_replace("/[^0-9]/", "", $n));

    if ($tam == 13) {
        // COM CÓDIGO DE ÁREA NACIONAL E DO PAIS e 9 dígitos
        return "+".substr($n, 0, $tam-11)." (".substr($n, $tam-11, 2).") ".substr($n, $tam-9, 5)."-".substr($n, -4);
    }
    if ($tam == 12) {
        // COM CÓDIGO DE ÁREA NACIONAL E DO PAIS
        return "+".substr($n, 0, $tam-10)." (".substr($n, $tam-10, 2).") ".substr($n, $tam-8, 4)."-".substr($n, -4);
    }
    if ($tam == 11) {
        // COM CÓDIGO DE ÁREA NACIONAL e 9 dígitos
        return "(".substr($n, 0, 2).") ".substr($n, 2, 5)."-".substr($n, 7, 11);
    }
    if ($tam == 10) {
        // COM CÓDIGO DE ÁREA NACIONAL
        return "(".substr($n, 0, 2).") ".substr($n, 2, 4)."-".substr($n, 6, 10);
    }
    if ($tam <= 9) {
        // SEM CÓDIGO DE ÁREA
        return substr($n, 0, $tam-4)."-".substr($n, -4);
    }
}

function statusContract($endTerm): stdClass
{
    $label = new stdClass();

    $today = Carbon::now()->toDate();
    $previousMonth = Carbon::create($endTerm)->sub(CarbonInterval::month(1))->toDate();

    $endTerm = Carbon::create($endTerm)->toDate();

    if ($endTerm->format(DATE_MY) > $previousMonth->format(DATE_MY)) {
        $label->class = "badge badge-warning";
        $label->label = "Contrato na Vigência";
        $label->end_term = $endTerm->format(DATE_DMY);
    }

    if ($today <= $endTerm && $today->format(DATE_MY) === $endTerm->format(DATE_MY)) {
        $label->class = "badge badge-danger";
        $label->label = "Vence no mês atual";
        $label->end_term = $endTerm->format(DATE_DMY);
    }

    if ($today > $endTerm) {
        $label->class = "badge badge-dark";
        $label->label = "Contrato vencido";
        $label->end_term = $endTerm->format(DATE_DMY);
    }

    return $label;
}

function generalStatus(int $objectStatus)
{
    $status = collect([
        ACTIVE => (object)['label' => 'Ativo', 'class' => 'badge badge-megna'],
        INACTIVE => (object)['label' => 'Inativo', 'class' => 'badge badge-dark'],
    ]);

    return $status->get($objectStatus);
}

function ticketStatus(int $objectStatus)
{
    $status = collect([
        ABERTO => (object)['label' => 'Aberto', 'class' => 'badge badge-success'],
        EMANDAMENTO => (object)['label' => 'Em Andamento', 'class' => 'badge badge-warning'],
        FECHADO => (object)['label' => 'Fechado', 'class' => 'badge badge-danger'],
    ]);

    return $status->get($objectStatus);
}

function statusProcess(int $objectStatus)
{
    $status = collect([
        PENDENTE => (object)['label' => 'Pendente', 'class' => 'badge badge-light-info text-info'],
        NEGOCIACAO => (object)['label' => 'Em Negociação', 'class' => 'badge badge-light-warning text-warning'],
        HOMOLOGADO => (object)['label' => 'Homologado', 'class' => 'badge badge-light-megna text-megna'],
    ]);

    return $status->get($objectStatus);
}

function statusItem(int $objectStatus)
{
    $status = collect([
        PENDENTE => (object)['label' => 'Pendente', 'class' => 'badge badge-megna'],
        NEGOCIACAO => (object)['label' => 'Negociação', 'class' => 'badge badge-warning'],
        HOMOLOGADO => (object)['label' => 'Homologado', 'class' => 'badge badge-primary'],
    ]);

    return $status->get($objectStatus);
}

function returnNameDocument(string $path)
{
    $array = explode('/', $path);
    return end($array);
}

function labelDocuments(int $type_document)
{
    $status = collect([
        HABILITATORIO => '',
        CREDENCIAMENTO => '',
        REGULARIDADEFISCAL => '',
        QUALIFICACAOEF => '',
        HABILITACAO => '',
    ]);

    return $status->get($type_document);
}

function unMasckMoney($value): string
{
    $newValue = explode('R$', $value);
    $valueToUnMask = trim(end($newValue));
    $value = str_replace(',', '.', $valueToUnMask);
    return str_replace(',', '', $valueToUnMask);
}

function brl2decimal($brl, $casasDecimais = 2): float
{

    // Se já estiver no formato USD, retorna como float e formatado
    if(preg_match('/^\d+\.{1}\d+$/', $brl))
        return (float) number_format($brl, $casasDecimais, '.', '');
    // Tira tudo que não for número, ponto ou vírgula
    $brl = preg_replace('/[^\d\.\,]+/', '', $brl);
    // Tira o ponto
    $decimal = str_replace('.', '', $brl);
    // Troca a vírgula por ponto
    $decimal = str_replace(',', '.', $decimal);
    return (float) number_format($decimal, $casasDecimais, '.', '');
}

function daysList($quantityDays, $format, $lastYear = null): array
{
    $list = [];

    if ($lastYear) {
        for ($i = $quantityDays; $i > 0; $i--) {
            $list[] = date("{$format}", strtotime("-$i days", strtotime('-1 Year')));
        }
    }

    if ($lastYear === null) {
        for ($i = $quantityDays; $i > 0; $i--) {
            $list[] = date("{$format}", strtotime("-$i days"));
        }
    }

    return $list;
}
