<?php

session_start();

include('db-movies.php');

$str = "<p><i>Фільм виведени згідно порядку в базі даних...</i></p>";

function show($val, $key)
{
    global $str;
    // $showStr = "<p>{$val['name']} ({$val['year']}) - {$val['genre']}. Сеанси: {$val['sessions']}. Режисер {$val['director']}. Видавництво {$val['studio']}.</p>";
    echo "        <div class='col-lg-3 col-md-6'>
    <div class='item'>
      <div class='thumb'>
        <a href='#'><img src='{$val['image']}'></a>
        <span class='price'>{$val['price']}</span>
      </div>
      <div class='down-content'>
        <span class='category'>{$val['genre']}</span>
        <h4>{$val['name']}</h4>
      </div>
    </div>
  </div>";
}

function test_input($data)
{
    return htmlspecialchars(stripslashes(trim($data)));
}

function search($movies, $data) {
    $data = test_input($data);
    $result = [];
    $isNoFound = false;
    foreach ($movies as $movie_index => $movie) {
        if (mb_stristr($movies[$movie_index]['name'], $data)) {
            $result[] = $movie_index;
        }

        foreach ($movie as $value) {
            if (is_string($value) && mb_stristr($value, $data)) {
                $result[] = $movie_index;
            }
        }
    }


    if(!$result) {
        $isNoFound = true;
    }

    if(!$isNoFound) {
        $noDuplic = array_unique($result);
        $search_result = array_flip($noDuplic);
        $movies_search_result = array_intersect_key($movies, $search_result);
        return $movies_search_result;
    }
}

function cmp_director($a, $b)
{
    return $a['director'] <=> $b['director'];
}

function cmp_name($a, $b)
{
    return $a['name'] <=> $b['name'];
}

function cmp_year($a, $b)
{
    return $a['year'] <=> $b['year'];
}

function cmp_genre($a, $b)
{
    return $a['genre'] <=> $b['genre'];
}

function cmp_rating($a, $b)
{
    return $a['rating'] <=> $b['rating'];
}

function cmp_studio($a, $b)
{
    return $a['studio'] <=> $b['studio'];
}

function cmp_sessions($a, $b)
{
    return $a['sessions'] <=> $b['sessions'];
}

function sorting($how_to_sort)
{
    global $movies, $str;
    uasort($movies, $how_to_sort);
    switch ($how_to_sort) {
        case "cmp_director":
            $str = "Сортування відбулось за режисерами...";
            break;
        case "cmp_year":
            $str = "Сортування відбулось за датою випуску...";
            break;
        case "cmp_name":
            $str = "Сортування відбулось за назвою...";
            break;
        case "cmp_genre":
            $str = "Сортування відбулось за жанром...";
            break;
        case "cmp_rating":
            $str = "Сортування відбулось за рейтингом...";
            break;
        case "cmp_studio":
            $str = "Сортування відбулось за кіностудією...";
            break;
        case "cmp_sessions":
            $str = "Сортування відбулось за сеансами...";
            break;
    }
}

function check_autorize($log, $pass)
{
    $users = get_users();
    if (array_key_exists($log, $users) && $pass == $users[$log]['pass']) {
        $_SESSION['authorized'] = 1;
        $_SESSION['login'] = $log;
        return true;
    }
    return false;
}

function check_log($log)
{
    $users = get_users();
    return array_key_exists($log, $users);
}

function add_user($login, $password)
{
    $users = get_users();
    if (check_log($login)) {
        return false;
    } else {
        $users[$login] = ["pass" => $password, 'role' => 'user'];
        update_users($users);
        $_SESSION['authorized'] = 1;
        $_SESSION['login'] = $login;
        return true;
    }
}

function update_users($users)
{
    $su = serialize($users);
    $file = fopen("db.txt", "w");
    if (fwrite($file, $su)) {
        fclose($file);
        return true;
    }
    fclose($file);
    return false;
}

function get_users()
{
    $filename = "db.txt";
    $file = fopen($filename, "r");
    $users = fread($file, filesize($filename));
    fclose($file);
    return unserialize($users);
}
