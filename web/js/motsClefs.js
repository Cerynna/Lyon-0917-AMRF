var data = [
    {id: 'école', text: 'école'},
    {id: 'périscolaire', text: 'périscolaire'},
    {id: 'formation', text: 'formation'},
    {id: 'crèche', text: 'crèche'},
    {id: 'restauration scolaire', text: 'restauration scolaire'},
    {id: 'médecin', text: 'médecin'},
    {id: 'maison de santé', text: 'maison de santé'},
    {id: 'infirmiers', text: 'infirmiers'},
    {id: 'professionnels de santé', text: 'professionnels de santé'},
    {id: 'maison de services publics', text: 'maison de services publics'},
    {id: 'commerces', text: 'commerces'},
    {id: 'Etat civil', text: 'Etat civil'},
    {id: 'manifestations citoyennes', text: 'manifestations citoyennes'},
    {id: 'vie associative', text: 'vie associative'},
    {id: 'economie sociale et solidaire', text: 'economie sociale et solidaire'},
    {id: 'élections', text: 'élections'},
    {id: 'cérémonie', text: 'cérémonie'},
    {id: 'parcs régionaux', text: 'parcs régionaux'},
    {id: 'espaces verts', text: 'espaces verts'},
    {id: 'écologie', text: 'écologie'},
    {id: 'développement durable', text: 'développement durable'},
    {id: 'urbanisme', text: 'urbanisme'},
    {id: 'rénovation/réfection', text: 'rénovation/réfection'},
    {id: 'transports', text: 'transports'},
    {id: 'voirie', text: 'voirie'},
    {id: 'voies navigables', text: 'voies navigables'},
    {id: 'intermodalités', text: 'intermodalités'},
    {id: 'transports', text: 'transports'},
    {id: 'station service', text: 'station service'},
    {id: 'patrimoine', text: 'patrimoine'},
    {id: 'valorisation du territoire', text: 'valorisation du territoire'},
    {id: 'église', text: 'église'},
    {id: 'logements sociaux', text: 'logements sociaux'},
    {id: 'EHPAD', text: 'EHPAD'},
    {id: 'maisons de quartier', text: 'maisons de quartier'},
    {id: 'CCAS', text: 'CCAS'},
    {id: 'emploi', text: 'emploi'},
    {id: 'entreprises', text: 'entreprises'},
    {id: 'startups', text: 'startups'},
    {id: 'espace de coworking', text: 'espace de coworking'},
    {id: 'télétravail ', text: 'télétravail '},
    {id: 'lecture', text: 'lecture'},
    {id: 'festival', text: 'festival'},
    {id: 'musique', text: 'musique'},
    {id: 'cinema', text: 'cinema'},
    {id: 'théâtre', text: 'théâtre'},
    {id: 'haut débit', text: 'haut débit'},
    {id: 'application', text: 'application'},
    {id: 'digital', text: 'digital'},
    {id: 'téléphonie mobile', text: 'téléphonie mobile'},
    {id: 'téléphonie fixe', text: 'téléphonie fixe'},
    {id: 'innovation', text: 'innovation'},
    {id: 'internet', text: 'internet'},
    {id: 'SPANC', text: 'SPANC'},
    {id: 'Station d\'épuration ', text: 'Station d\'épuration '},
    {id: 'réseaux', text: 'réseaux'},
    {id: 'Coopération décentralisée', text: 'Coopération décentralisée'},
    {id: 'Arménie', text: 'Arménie'},
    {id: 'Europe', text: 'Europe'},
    {id: 'Jumelage', text: 'Jumelage'}


];

$(document).ready(function () {
    $('.js-example-basic-multiple').select2({
        placeholder: "Select a state",
        data: data
    });
    $(".js-example-data-array").select2({
        data: data
    })
});