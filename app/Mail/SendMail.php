<?php

namespace App\Mail;

use App\Venda;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Venda $vendas)
    {
        $this->vendas = $vendas;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('no@replay.com')
                    ->subject('Vendas do dia')
                    ->view('mail.sales')
                    ->with([
                        'vendas' => $this->vendas
                    ]);
    }
}
