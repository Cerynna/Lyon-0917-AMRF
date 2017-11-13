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

    var accentMap = {
        "á": "a",
        "à": "a",
        "â": "a",
        "ä": "a",
        "ç": "c",
        "é": "e",
        "è": "e",
        "ê": "e",
        "ë": "e",
        "î": "i",
        "ï": "i",
        "ô": "o",
        "ö": "o",
        "ù": "u",
        "û": "u",
        "ü": "u",
        "Â": "A",
        "Ä": "A",
        "À": "A",
        "Ç": "C",
        "Ê": "E",
        "Ë": "E",
        "É": "E",
        "È": "E",
        "Î": "I",
        "Ï": "I",
        "Ô": "O",
        "Ö": "O",
        "Û": "U",
        "Ü": "U",
        "Ù": "U"
    };

    var normalize = function (term) {
        var ret = "";
        for (var i = 0; i < term.length; i++) {
            ret += accentMap[term.charAt(i)] || term.charAt(i);
        }
        return ret;
    };

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

                /* accent map in dev....!!!!!!!!
                                var matcher = new RegExp($.ui.autocomplete.escapeRegex(request.term), "i");
                                response($.grep(availableTags, function (value) {
                                    value = value.label || value.value || value;
                                    return matcher.test(value) || matcher.test(normalize(value));
                                }));

                                */
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
