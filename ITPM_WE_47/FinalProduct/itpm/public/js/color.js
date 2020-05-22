function codeColor() {
    var x, i, j, k, l, modes = ["html", "js", "java", "css", "sql", "python"];
    if (!document.getElementsByClassName) { return; }
    k = modes.length;
    for (j = 0; j < k; j++) {
        x = document.getElementsByClassName(modes[j] + "High");
        l = x.length;
        for (i = 0; i < l; i++) {
            x[i].innerHTML = codeColorize(x[i].innerHTML, modes[j]);
        }
    }
}
function codeColorize(x, lang) {
    var commentcolor = "#025E13";
    var javacolor = "#000";
    var javakeywordcolor = "#005cc5";
    var javastringcolor = "#088C00";
    var javanumbercolor = "#d73a49";
    var javapropertycolor = "#000";
    var javaidentifiers = "yellow";
    var javaOperators = "#BF4EFF";
    // #005cc5

    if (!lang) { lang = "java"; }
    if (lang == "java") { return javaMode(x); }
    return x;

    function commentMode(txt) {
        return "<span style=color:" + commentcolor + ">" + txt + "</span>";
    }




    function getDotPos(txt, func) {
        var x, i, j, s, e, arr = [".", "<", " ", ";", "(", "+", ")", "[", "]", ",", "&", ":", "{", "}", "/", "-", "*", "|", "%"];
        s = txt.indexOf(".");
        if (s > -1) {
            x = txt.substr(s + 1);
            for (j = 0; j < x.length; j++) {
                cc = x[j];
                for (i = 0; i < arr.length; i++) {
                    if (cc.indexOf(arr[i]) > -1) {
                        e = j;
                        return [s + 1, e + s + 1, func];
                    }
                }
            }
        }
        return [-1, -1, func];
    }

    function getMinPos() {
        var i, arr = [];
        for (i = 0; i < arguments.length; i++) {
            if (arguments[i][0] > -1) {
                if (arr.length == 0 || arguments[i][0] < arr[0]) { arr = arguments[i]; }
            }
        }
        if (arr.length == 0) { arr = arguments[i]; }
        return arr;
    }


    function javaMode(txt) {
        var rest = txt, done = "", esc = [], i, cc, tt = "", sfnuttpos, dfnuttpos, compos, comlinepos, keywordpos, numpos, mypos, dotpos, y;
        for (i = 0; i < rest.length; i++) {
            cc = rest.substr(i, 1);
            if (cc == "\\") {
                esc.push(rest.substr(i, 2));
                cc = "W3JSESCAPE";
                i++;
            }
            tt += cc;
        }
        rest = tt;
        y = 1;
        while (y == 1) {
            sfnuttpos = getPos(rest, "'", "'", javaStringMode);
            dfnuttpos = getPos(rest, '"', '"', javaStringMode);

            compos = getPos(rest, /\/\*/, "*/", commentMode);
            comlinepos = getPos(rest, /\/\//, "<br>", commentMode);

            numpos = getNumPos(rest, javaNumberMode);
            keywordpos = getKeywordPos("java", rest, javaKeywordMode);
            // identifiers = getIdentifierPos("java", rest, javaIdentifierMode);
            // operatorsFound = getOperatorsPos("java", rest, javaOperatorMode);
            

            dotpos = getDotPos(rest, javaPropertyMode);
            if (Math.max(numpos[0], sfnuttpos[0], dfnuttpos[0], compos[0], comlinepos[0], keywordpos[0], dotpos[0] ) == -1) { break; }
            mypos = getMinPos(numpos, sfnuttpos, dfnuttpos, compos, comlinepos, keywordpos, dotpos);
            if (mypos[0] == -1) { break; }
            if (mypos[0] > -1) {
                done += rest.substring(0, mypos[0]);
                done += mypos[2](rest.substring(mypos[0], mypos[1]));
                rest = rest.substr(mypos[1]);
            }
        }
        rest = done + rest;
        for (i = 0; i < esc.length; i++) {
            rest = rest.replace("W3JSESCAPE", esc[i]);
        }
        return "<span style=\"color:" + javacolor + "\">" + rest + "</span>";
    }
    function javaStringMode(txt) {
        return "<span style=\"color:" + javastringcolor + "\">" + txt + "</span>";
    }
    function javaKeywordMode(txt) {
        return "<span style=\"color:" + javakeywordcolor + "\">" + txt + "</span>";
    }

    function javaIdentifierMode(txt) {
        return "<span style=\"color:" + javaidentifiers + "\">" + txt + "</span>";
    }

    function javaNumberMode(txt) {
        return "<span style=\"color:" + javanumbercolor + "\">" + txt + "</span>";
    }
    function javaPropertyMode(txt) {
        return "<span style=\"color:" + javapropertycolor + "\">" + txt + "</span>";
    }

    function javaOperatorMode(txt) {
        return "<span style=\"color:" + javaOperators + ";font-weight:900;\" >" + txt + "</span>";
    }

    function getKeywordPos(typ, txt, func) {
        var words, i, pos, rpos = -1, rpos2 = -1, patt;
        if (typ == "java") {
            words = [
                "true","false", "NaN","null","void","enum",
                "import", "export", "function" , "class", "new" , "this", "return", "super",
                "try" , "catch", "finally", "throw","throws",
                "public","private","protected", "default", //Access Modifiers
                "final", "abstract", "transient","synchronized","native", "strictfp", "volatile","static", //NonAccess Modifiers
                "const", "var", "let",
                "break","continue",  "goto",
                "else", 
                "instanceof","typeof",
                "implements","extends", "interface",
                "delete","package","arguments","yield","event","debugger"
                // "eval","in", "with"
            ];
        }
        for (i = 0; i < words.length; i++) {
            pos = txt.toLowerCase().indexOf(words[i]);
            if (pos > -1) {

                patt = /\W/g;
                if(words[i] == 'else'){
                    rpos = pos;
                    rpos2 = rpos + words[i].length; 
                }
                if (txt.substr(pos + words[i].length, 1).match(patt) && txt.substr(pos - 1, 1).match(patt)) {
                    if (pos > -1 && (rpos == -1 || pos < rpos)) {
                        rpos = pos;
                        rpos2 = rpos + words[i].length; 
                    }

                }
                
            }
        }
        return [rpos, rpos2, func];
    }


    function getIdentifierPos(typ, txt, func) {
        var words, i, pos, rpos = -1, rpos2 = -1, patt;
        if (typ == "java") {
            words = ["","","","","","","","",""];
        }
        for (i = 0; i < words.length; i++) {
            pos = txt.toLowerCase().indexOf(words[i]);
            if (pos > -1) {

                patt = /\W/g;
                if(words[i] == 'else'){
                    rpos = pos;
                    rpos2 = rpos + words[i].length; 
                }
                if (txt.substr(pos + words[i].length, 1).match(patt) && txt.substr(pos - 1, 1).match(patt)) {
                    if (pos > -1 && (rpos == -1 || pos < rpos)) {
                        rpos = pos;
                        rpos2 = rpos + words[i].length; 
                    }

                }
                
            }
        }
        return [rpos, rpos2, func];
    }

    function getOperatorsPos(typ, txt, func){
        var words, i, pos, rpos = -1, rpos2 = -1, patt;
        if (typ == "java") {
            words = ["\="];
        }
        for (i = 0; i < words.length; i++) {
            pos = txt.toLowerCase().indexOf(words[i]);
            if (pos > -1) {

                patt = /\W/g;
                if (txt.substr(pos + words[i].length, 1).match(patt) && txt.substr(pos - 1, 1).match(patt)) {
                    if (pos > -1 && (rpos == -1 || pos < rpos)) {
                        rpos = pos;
                        rpos2 = rpos + words[i].length; 
                    }

                }
            }
        }
        return [rpos, rpos2, func];
    }

    function getPos(txt, start, end, func) {
        var s, e;
        s = txt.search(start);
        e = txt.indexOf(end, s + (end.length));
        if (e == -1) { e = txt.length; }
        return [s, e + (end.length), func];
    }

    function getNumPos(txt, func) {
        var arr = ["<br>", " ", ";", "(", "+", ")", "[", "]", ",", "&", ":", "{", "}", "/", "-", "*", "|", "%", "="], i, j, c, startpos = 0, endpos, word;
        for (i = 0; i < txt.length; i++) {
            for (j = 0; j < arr.length; j++) {
                c = txt.substr(i, arr[j].length);
                if (c == arr[j]) {
                    if (c == "-" && (txt.substr(i - 1, 1) == "e" || txt.substr(i - 1, 1) == "E")) {
                        continue;
                    }
                    endpos = i;
                    if (startpos < endpos) {
                        word = txt.substring(startpos, endpos);
                        if (!isNaN(word)) { return [startpos, endpos, func]; }
                    }
                    i += arr[j].length;
                    startpos = i;
                    i -= 1;
                    break;
                }
            }
        }
        return [-1, -1, func];
    }
}

