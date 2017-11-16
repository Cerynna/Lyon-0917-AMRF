$(function () {
    var communes = [
        "01 Ain",
        "02 Aisne",
        "03 Allier",
        "04 Alpes-de-Haute-Provence",
        "06 Alpes-Maritimes",
        "07 Ardèche",
        "08 Ardennes",
        "09 Ariège",
        "10 Aube",
        "11 Aude",
        "12 Aveyron",
        "67 Bas-Rhin",
        "13 Bouches-du-Rhône",
        "14 Calvados",
        "15 Cantal",
        "16 Charente",
        "17 Charente-Maritime",
        "18 Cher",
        "19 Corrèze",
        "2A Corse-du-Sud",
        "21 Côte-d'Or",
        "22 Côtes-d'Armor",
        "23 Creuse",
        "79 Deux-Sèvres",
        "24 Dordogne",
        "25 Doubs",
        "26 Drôme",
        "91 Essonne",
        "27 Eure",
        "28 Eure-et-Loir",
        "29 Finistère",
        "30 Gard",
        "32 Gers",
        "33 Gironde",
        "68 Haut-Rhin",
        "2B Haute-Corse",
        "31 Haute-Garonne",
        "43 Haute-Loire",
        "52 Haute-Marne",
        "70 Haute-Saône",
        "74 Haute-Savoie",
        "87 Haute-Vienne",
        "05 Hautes-Alpes",
        "65 Hautes-Pyrénées",
        "92 Hauts-de-Seine",
        "34 Hérault",
        "35 Ille-et-Vilaine",
        "36 Indre",
        "37 Indre-et-Loire",
        "38 Isère",
        "39 Jura",
        "40 Landes",
        "41 Loir-et-Cher",
        "42 Loire",
        "44 Loire-Atlantique",
        "45 Loiret",
        "46 Lot",
        "47 Lot-et-Garonne",
        "48 Lozère",
        "49 Maine-et-Loire",
        "50 Manche",
        "51 Marne",
        "53 Mayenne",
        "54 Meurthe-et-Moselle",
        "55 Meuse",
        "56 Morbihan",
        "57 Moselle",
        "58 Nièvre",
        "59 Nord",
        "60 Oise",
        "61 Orne",
        "75 Paris",
        "62 Pas-de-Calais",
        "63 Puy-de-Dôme",
        "64 Pyrénées-Atlantiques",
        "66 Pyrénées-Orientales",
        "69 Rhône",
        "71 Saône-et-Loire",
        "72 Sarthe",
        "73 Savoie",
        "77 Seine-et-Marne",
        "76 Seine-Maritime",
        "93 Seine-Saint-Denis",
        "80 Somme",
        "81 Tarn",
        "82 Tarn-et-Garonne",
        "90 Territoire de Belfort",
        "95 Val-d'Oise",
        "94 Val-de-Marne",
        "83 Var",
        "84 Vaucluse",
        "85 Vendée",
        "86 Vienne",
        "88 Vosges",
        "89 Yonne",
        "78 Yvelines"
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

    $("#communes").autocomplete({
        source: function (request, response) {
            var matcher = new RegExp($.ui.autocomplete.escapeRegex(request.term), "i");
            response($.grep(communes, function (value) {
                value = value.label || value.value || value;
                return matcher.test(value) || matcher.test(normalize(value));
            }));
        },
        open: function() {
            var position = $("#results").position(),
                left = position.left, top = position.top;

            $("#results ").css({
                top: top + 0 + "px" });
        }
    });
});



