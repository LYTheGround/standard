<?php

use App\Month;
use App\Order;
use App\Purchase;
use App\Quote;
use App\Trade;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Http\Request;

class BuySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i < 6; $i++) {

            $dataPurchase = ['qt' => 10, 'product' => 1];

            $request = Request::create('/', 'post', [
                "product[$i]" => 1, "pu[$i]" => 100, 'deal' => 1
            ]);

            $this->buy($dataPurchase, $request);
        }

    }

    private function buy($dataPurchase, $request)
    {
        // trade

        $trade = new Trade();

        $trade = $trade->onStore(Carbon::now(), true);

        // purchase
        $purchase = new Purchase();

        $purchase->onStore($dataPurchase, $trade);

        $trade->onPurchased();

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
            $product = $order->purchase->product;
            $product->update([
                'amount' => $product->amount + $order->ttc
            ]);
        }

        $term = new \App\Term();

        $term->onStore(Carbon::now(),$quote->ttc, $quote, new Month());

        // invoiced

        $trade->onStoreInvoice();
    }
}
