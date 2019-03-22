<?php

use App\Month;
use App\Order;
use App\Quote;
use App\Trade;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Http\Request;

class SaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i < 6; $i++) {
            $request = Request::create('/sale', 'post', [
                'qt' => 10, 'purchase' => $i, "pu[" . $i . "]" => 150, 'deal' => 1
            ]);

            $this->sale($request);

        }


    }

    private function sale($request)
    {
        // trade

        $trade = new Trade();

        $trade = $trade->onStore(Carbon::now());

        // sold

        $sold = new \App\Sold();

        $sold->onStore($request, $trade);

        $trade->onSold();

        // Quote and Orders

        $quote = new Quote();

        $order = new Order();

        $quote = $quote->onStore($request, $trade, $order);

        $trade->onStoreQuote();

        // delivery

        $trade->onStoreDelivery();

        // Form

        $trade->onStoreForm();

        // stored

        $trade->onStoreStored();

        // Term



        foreach ($quote->orders as $order) {

            $product = $order->sold->purchase->product;
            $purchaseOrder = $order->orderBuy($order->sold->purchase)[0];
            $ttc = ($purchaseOrder->ttc / $order->sold->purchase->qt) * $order->sold->qt;

            $product->update([
                'amount' => $product->amount - $ttc
            ]);
        }

        foreach ($trade->solds as $sold) {

            $sold->purchase->update([
                'qt_offer'    => $sold->purchase->qt_offer - $sold->qt
            ]);

            $sold->purchase->product->update([
                'qt'    => $sold->purchase->product->qt - $sold->qt
            ]);

        }

        $term = new \App\Term();

        $term->onStore(Carbon::now(), $quote->ttc, $quote, new Month());

        // invoiced

        $trade->onStoreInvoice();
    }
}
