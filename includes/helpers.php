<?php
function generate_newspaper_html($id, $title, $imgUrl)
{
    $imgUrl = 'https://protoselida.24media.gr/' . $imgUrl;
    $html = '<div class="newspaper-item">';
    $html .= '<p>' . $title . '</p>';
    $html .= '<a href="' . $imgUrl . '" target="_blank"><img id="' . $id . '" src="' . $imgUrl . '" alt="' . $title . '"/></a>';
    $html .= '</div>';

    return $html;
}

function generate_newspaper_slides($id, $title, $imgUrl)
{
    $imgUrl = 'https://protoselida.24media.gr/' . $imgUrl;
    $html = '<li class="newspaper-item splide__slide">';
    $html .= '<a href="' . $imgUrl . '" target="_blank"><img id="' . $id . '" src="' . $imgUrl . '" alt="' . $title . '"/></a>';
    $html .= '</li>';

    return $html;
}


function greek_newspapers_category_title($name)
{
    switch ($name) {
        case 'politikes':
            $name = 'Πολιτικές';
            break;
        case 'oikonomikes':
            $name = 'Οικονομικές';
            break;
        case 'kuriakatikes':
            $name = 'Κυριακάτικες';
            break;
        case 'athlitikes':
            $name = 'Αθλητικές';
            break;
        case 'evdomadiaies':
            $name = 'Εβδομαδιαίες';
            break;
        case 'perifereia':
            $name = 'Περιφέρεια';
            break;
        case 'evdomadiaia_periodika':
            $name = 'Εβδομαδιαία Περιοδικά';
            break;
        case 'athlitika_periodika':
            $name = 'Αθλητικά Περιοδικά';
            break;
        case 'free_press':
            $name = 'Free Press';
            break;
        case 'miniaia_periodika':
            $name = 'Μικρές Αγγελίες - Περιοδικά';
            break;
        default:
            // handle default case
            break;
    }
    return $name;
}
