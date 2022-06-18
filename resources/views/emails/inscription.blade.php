@component('mail::message')

<p>
    Cher participant,
</p>

<p>
    Vous faites désormais parti de la liste des pré-inscrits au HTIC 2022.
</p>

<p>
    Afin de finaliser votre inscription, veuillez :<br>
    1. Procéder au paiement suivant les modalités d’inscription <a target="_blanc" href="https://drive.google.com/file/d/1r0ntgMc6N2noTlpuNOyj9EQESsqFyt25/view?usp=sharing">ici.</a><br>
    2. Scanner votre reçu de paiement<br>
    3. Attacher votre justificatif de paiement <a target="_blanc" href="https://htic2022v.hashtagsante.ma/">ici</a> ou envoyer le à l’adresse suivante : <a target="_blanc" href="mailto:htic2022@hashtagsante.ma">htic2022@hashtagsante.ma</a><br>
</p>

<p>
    Au plus tard 48h (ouvrable) et suite à la vérification des informations, vous recevrez un Email de confirmation de votre inscription au HTIC 2022.
</p>

<p style="background-color: white">
    <img   src="{{ 'http://127.0.0.1:8000/storage/' . $msg['barecode'] }}" class="center">
    {{-- <a v-if="!starttelecharg" href="{{ 'http://127.0.0.1:8000/storage/' . $msg['barecode'] }}" target="_blanck"  download> TÉLÉCHARGER MON CODE</a> --}}
</p>

<p>
    Bien à vous.
</p>

<style>
    .center {
        display: block;
        margin-left: auto;
        margin-right: auto;
        width: 100%;
        height: 50px;
        padding: 5px
        
    }
    .bodytext{
        background-color:rgb(241, 241, 241);
        padding: 5px;
        
    }
    .imgcadre{
        background-color: white!important;
        padding: 20px
    }
</style>

{{-- @component('mail::button', ['url' => 'http://127.0.0.1:8000/report', 'color' => 'success'])

@endcomponent --}}

@endcomponent
