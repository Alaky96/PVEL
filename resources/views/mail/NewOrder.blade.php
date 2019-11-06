
<body>
<style>
    .content
    {
        font-family: 'Raleway', sans-serif;
        background-color: #c5c5c5;
        border-radius: 10px;
        width: 50vw;
        padding: 10px;
    }

    .box{
        background: white;
        border-radius: 10px;
        padding: 10px;
    }

    button
    {
        display: inline-block;
        padding: 6px 12px;
        margin-bottom: 0;
        background: #1d99ff;
        color: #ffffff;
        min-height: 55px;
        width: 100%;
        line-height: 38px;
        font-size: 22px;
        font-weight: 500;
        border-radius: 3px;
        border: 0;
        cursor: pointer;
    }
</style>
<div class = "content" style=" font-family: 'Raleway', sans-serif;
        background-color: #c5c5c5;
        border-radius: 10px;
        width: 50vw;
        padding: 10px;">
    <div class = "box" style=" background: white;
        border-radius: 10px;
        padding: 10px;">
        <h1 style ="font-weight: bolder">PVEL</h1>
        <h2>Nouvelle Commande</h2>

        <p>
           Nous avons reçu une nouvelle commande pour vous. <br/>
            Veuillez consulter l'expédition #{{sprintf('%06d', $shipment->id)}} et l'expédier dans les plus brefs déalis.<br/>
            De plus, nous vous demandons de bien vouloir indiquer les informations de suivi dès que possible.<br/>
            Il vous est possible, à tout moment, de consulter les détails de l'expédition en cliquant <a href = "{{route("shipments.edit", ['shipment'=>$shipment->id])}}">ici</a>.
            <br/><br/>Merci de votre confiance,<br/>
            L'Équipe PVEL
        </p>
        <div style="text-align:center">
            <a href ="{{route("shipments.edit", ['shipment'=>$shipment->id])}}" ><button style=" display: inline-block;
        padding: 6px 12px;
        margin-bottom: 0;
        background: #1d99ff;
        color: #ffffff;
        min-height: 55px;
        width: 100%;
        line-height: 38px;
        font-size: 22px;
        font-weight: 500;
        border-radius: 3px;
        border: 0;
        cursor: pointer;">Consulter les détails de l'expédition</button></a>
        </div>
    </div>
    <p style="text-align:center">Contactez-nous : <a href="mailto:info@PVEL.com">info@PVEL.com</a></p>
</div>

</body>
