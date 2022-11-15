<?php

namespace App\Controllers;

use App\Models\Quote;
use Exception;
use Traits\Controllers\CoverageActive;
use Traits\Controllers\InsurerInsuranceActive;
use Traits\Controllers\quoteControllerUserController;

class QuoteController extends Controller
{
    use InsurerInsuranceActive;
    use CoverageActive;
    use quoteControllerUserController;

    public function index(): bool|array
    {
        return (new Quote()) -> index();
    }

    public function recent(): void
    {
        echo json_encode((new Quote()) -> recent());
    }

    public function accordingClient(Quote $quote): void
    {
        try {
            $client_quotes = $quote -> accordingClient();
            if (empty($client_quotes)) {
                throw new Exception('El cliente no tiene cotizaciones');
            }
            echo json_encode($client_quotes);
        } catch (Exception $e) {
            echo json_encode($e -> getMessage());
        }
    }

    public function create(Quote $quote): void
    {
        $quote -> create();
        $this -> response('Cotización registrada');
    }

    public function show(Quote $quote): void
    {
        echo json_encode($quote -> show());
    }

    public function view(string $view): void
    {
        $status = (new Quote()) -> estado();
        require_once $view;
    }

    public function dataView(): void
    {
        $array = $this -> productsActive();
        $array['coverages'] = $this -> coverageActive();
        echo json_encode($array);
    }

    public function update(Quote $quote): void
    {
        $quote -> update();
        $this -> response('Cotización actualizada');
    }

    public function delete(Quote $quote): void
    {
        $quote -> delete();
        $this -> response('Cotización eliminada');
    }
}
