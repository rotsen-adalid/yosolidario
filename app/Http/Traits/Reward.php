<?php
namespace App\Http\Traits;

use App\Models\CampaignReward;

trait Reward {
    
    // create rewards BO
    public function createRewarsBO($id) {

        $languaje = 'es';

        if($languaje == 'es') {
            $description_one = "¡Gracias! No hay aportación pequeña cuando se trata de ayudar.";
            $description_two = "¡Muchas gracias! Recibirás un correo personalizado de agradecimiento.";
            $description_three = "¡Wow! Tu aportación es muy valiosa, por eso queremos hacerte llegar un certificado digital de agradecimiento.";
            $description_four = "¡Muchas gracias! Tu aportación está haciendo una gran diferencia. Como agradecimiento te haremos una mención especial en nuestras redes sociales.";
            $description_five = "¡Eres un súper colaborador! Tu aportación significa mucho para la recaudación. Como agradecimiento queremos hacerte llegar un video de agradecimiento + un certificado digital + una mención especial en nuestras redes sociales.";
        }

        if($this->country_id) {
            $this->amountOne = 50;
            $this->amountTwo = 100;
            $this->amountThree = 150;
            $this->amountFour = 200;
            $this->amountFive = 250;
        }

        $recordOne = CampaignReward::create([
            'image_url' => null,
            'amount' => $this->amountOne,
            'description' => $description_one,
            'delivery_date' => null,
            'limiter' => 'NO',
            'quantity' => 1,
            'collaborators' => 0,
            'campaign_id' => $id,
        ]);
        $recordTwo = CampaignReward::create([
            'image_url' => null,
            'amount' => $this->amountTwo,
            'description' => $description_two,
            'delivery_date' => null,
            'limiter' => 'NO',
            'quantity' => 1,
            'collaborators' => 0,
            'campaign_id' => $id,
        ]);
        $recordThree = CampaignReward::create([
            'image_url' => null,
            'amount' =>  $this->amountThree,
            'description' => $description_three,
            'delivery_date' => null,
            'limiter' => 'NO',
            'quantity' => 1,
            'collaborators' => 0,
            'campaign_id' => $id,
        ]);
        $recordFour = CampaignReward::create([
            'image_url' => null,
            'amount' => $this->amountFour,
            'description' => $description_four,
            'delivery_date' => null,
            'limiter' => 'NO',
            'quantity' => 1,
            'collaborators' => 0,
            'campaign_id' => $id,
        ]);
        $recordFive = CampaignReward::create([
            'image_url' => null,
            'amount' => $this->amountFive,
            'description' => $description_five,
            'delivery_date' => null,
            'limiter' => 'NO',
            'quantity' => 1,
            'collaborators' => 0,
            'campaign_id' => $id,
        ]);
    }
}