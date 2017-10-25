$(function () {
    var availableTags = [
        "école",
        "périscolaire",
        "formation",
        "crèche",
        "restauration scolaire",
        "médecin",
        "maison de santé",
        "infirmiers",
        "professionnels de santé",
        "maison de services publics",
        "commerces",
        "Etat civil",
        "manifestations citoyennes",
        "vie associative",
        "economie sociale et solidaire",
        "élections",
        "cérémonie",
        "parcs régionaux",
        "espaces verts",
        "écologie",
        "développement durable",
        "urbanisme",
        "rénovation/réfection",
        "transports",
        "voirie",
        "voies navigables",
        "intermodalités",
        "transports",
        "station service",
        "patrimoine",
        "valorisation du territoire",
        "église",
        "logements sociaux",
        "EHPAD",
        "maisons de quartier",
        "CCAS",
        "emploi",
        "entreprises",
        "startups",
        "espace de coworking",
        "télétravail",
        "lecture",
        "festival",
        "musique",
        "cinema",
        "théâtre",
        "haut débit",
        "application",
        "digital",
        "téléphonie mobile",
        "téléphonie fixe",
        "innovation",
        "internet",
        "SPANC",
        "Station d'épuration ",
        "réseaux",
        "Coopération décentralisée",
        "Arménie",
        "Europe",
        "Jumelage"
    ];

    function split(val) {
        return val.split(/,\s*/);
    }

    function extractLast(term) {
        return split(term).pop();
    }

    $("#motsCle")
    // don't navigate away from the field on tab when selecting an item
        .on("keydown", function (event) {
            if (event.keyCode === $.ui.keyCode.TAB &&
                $(this).autocomplete("instance").menu.active) {
                event.preventDefault();
            }
        })
        .autocomplete({
            minLength: 0,
            source: function (request, response) {
                // delegate back to autocomplete, but extract the last term
                response($.ui.autocomplete.filter(
                    availableTags, extractLast(request.term)));
            },
            focus: function () {
                // prevent value inserted on focus
                return false;
            },
            select: function (event, ui) {
                var terms = split(this.value);
                // remove the current input
                terms.pop();
                // add the selected item
                terms.push(ui.item.value);
                // add placeholder to get the comma-and-space at the end
                terms.push("");
                this.value = terms.join(", ");
                return false;
            }
        });
});
