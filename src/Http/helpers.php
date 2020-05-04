<?php

function admix_is_active($route = '')
{
    $url = parse_url($route);
    $path = trim($url['path'], '/');

    return request()->is($path . '*');
}

function admix_cannot($action, $place)
{
    return auth('admix-web')
        ->user()
        ->cannot($action, $place);
}

function audit_events($event = '')
{
    $events['created'] = 'Criou';
    $events['updated'] = 'Alterou';
    $events['deleted'] = 'Removeu';
    $events['restored'] = 'Restaurou';

    if (!$event) {
        return $events;
    }

    if (isset($events[$event])) {
        return $events[$event];
    }

    return $event;
}

function audit_alias($model = '')
{
    $alias = config('audit-alias');

    if (!$model) {
        return $alias;
    }

    if (isset($alias[$model])) {
        return $alias[$model];
    }

    return $model;
}

function human_number($num, $places = 2, $type = 'metric')
{
    if ('metric' === $type) {
        $k = 'K';
        $m = 'M';
    } else {
        $k = ' thousand';
        $m = ' million';
    }
    if ($num < 1000) {
        $num_format = number_format($num);
    } elseif ($num < 1000000) {
        $num_format = number_format($num / 1000, $places) . $k;
    } else {
        $num_format = number_format($num / 1000000, $places) . $m;
    }

    return $num_format;
}

function remove_accents($string)
{
    if (is_array($string)) {
        foreach ($string as $key => $value) {
            $array[$key] = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $value);
        }

        return $array;
    }

    return iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $string);
}

function only_numbers($string)
{
    return preg_replace('/[^0-9]/', '', $string);
}

function states($state = null)
{
    $states = [
        'AC' => 'Acre',
        'AL' => 'Alagoas',
        'AP' => 'Amapá',
        'AM' => 'Amazonas',
        'BA' => 'Bahia',
        'CE' => 'Ceará',
        'DF' => 'Distrito Federal',
        'ES' => 'Espírito Santo',
        'GO' => 'Goiás',
        'MA' => 'Maranhão',
        'MT' => 'Mato Grosso',
        'MS' => 'Mato Grosso do Sul',
        'MG' => 'Minas Gerais',
        'PA' => 'Pará',
        'PB' => 'Paraíba',
        'PR' => 'Paraná',
        'PE' => 'Pernambuco',
        'PI' => 'Piauí',
        'RJ' => 'Rio de Janeiro',
        'RN' => 'Rio Grande do Norte',
        'RS' => 'Rio Grande do Sul',
        'RO' => 'Rondônia',
        'RR' => 'Roraima',
        'SC' => 'Santa Catarina',
        'SP' => 'São Paulo',
        'SE' => 'Sergipe',
        'TO' => 'Tocantins',
    ];

    if (isset($states[$state])) {
        return $states[$state];
    }

    return $states;
}

function float_to_db($value)
{
    if (!$value) {
        return null;
    }

    return trim(str_replace('R$', '', str_replace(',', '.', str_replace('.', '', $value))));
}

function db_to_float($value)
{
    if (!$value) {
        return null;
    }

    return number_format($value, 2, ',', '.');
}

function date_to_db($value, $formFormat = 'd/m/Y H:i')
{
    if (!$value) {
        return null;
    }

    return \Carbon\Carbon::createFromFormat($formFormat, $value)
        ->toDateTimeString();
}

if (!function_exists('db_to_date')) {
    function db_to_date($value, $default = null, $format = 'd/m/Y H:i')
    {
        if (!$value) {
            return $default;
        }

        return optional($value)->format($format);
    }
}


if (!function_exists('filter')) {
    function filter($field)
    {
        if (isset(request()->get('filter', [$field => ''])[$field])) {
            return request()->get('filter', [$field => ''])[$field];
        }
    }
}

if (!function_exists('column_sort')) {
    function column_sort($title, $field, $sort = true)
    {
        if (!$sort) {
            return '<span class="text-muted font-weight-bold">' . $title . '</span>';
        }

        $sort = request()->get('sort');

        if (substr($sort, 0, 1) == '-') {
            $param['sort'] = substr($sort, 1);
            $icon = 'icon fe-chevron-up';
        } else {
            $param['sort'] = '-' . $sort;
            $icon = 'icon fe-chevron-down';
        }

        if (($sort != $field) && ($sort != '-' . $field)) {
            $param['sort'] = $field;
            $icon = 'icon fe-code';
        }

        $queryString = request()->getQueryString();
        parse_str($queryString, $query);

        unset($query['page']);
        unset($query['sort']);
        $fullUrl = request()->url() . '?' . http_build_query($query + $param);

        return sprintf('<a href="%s" class="font-weight-bold text-muted text-decoration-none">%s</a> <i class="%s"></i>', $fullUrl, $title, $icon);
    }
}

if (!function_exists('default_sort')) {
    function default_sort($fields)
    {
        return collect($fields)->map(function ($value) {
            $field = ltrim($value, '-');
            $direction = ($value[0] == '-') ? 'desc' : 'asc';

            return [
                'field' => $field,
                'direction' => $direction,
            ];
        });
    }
}

if (!function_exists('thumb')) {
    function thumb($model, $name, $config = [], $placeholder = 'data:image/gif;base64,R0lGODlhAQABAIAAAMLCwgAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==')
    {
        $default = [
            'w' => 800,
            'h' => 600,
            'q' => 80,
            'fit' => 'crop',
            //'fm' => 'webp',
        ];

        $mergedConfig = array_merge($default, $config);

        $location = '/media/';
        if ('cdn' === config('filesystems.default')) {
            $location = config('filesystems.disks.cdn.url') . '/r/';
        }

        $image = $model->getFirstMedia($name) ?? null;

        if (!$image) {
            return (object)[
                'original' => $placeholder,
                'name' => $placeholder,
                'meta' => 'sem imagem',
            ];
        }

        return (object)[
            'original' => $image->getUrl('thumb'),
            'name' => $location . image_path_builder($image->getUrl('thumb'), $mergedConfig),
            'meta' => optional($image->getCustomProperty('meta'))[app()->getLocale()],
        ];
    }
}

if (!function_exists('thumbs')) {
    function thumbs($model, $name, $config = [])
    {
        $default = [
            'w' => 800,
            'h' => 600,
            'q' => 80,
            'fit' => 'crop',
            //'fm' => 'webp',
        ];

        $mergedConfig = array_merge($default, $config);

        $location = '/media/';

        if ('cdn' === config('filesystems.default')) {
            $location = config('filesystems.disks.cdn.url') . '/r/';
        }

        $images = $model->getMedia($name) ?? null;

        if (!$images) {
            return collect([]);
        }

        $items = [];
        foreach ($images as $image) {
            $items[] = (object)[
                'original' => $location . $image->getUrl('thumb'),
                'name' => $location . image_path_builder($image->getUrl('thumb'), $mergedConfig),
                'meta' => optional($image->getCustomProperty('meta'))[app()->getLocale()],
            ];
        }

        return collect($items);
    }
}

if (!function_exists('image')) {
    function image($model, $name, $placeholder = '/images/sem-imagem.jpg')
    {
        $location = '/media/';
        if (config('filesystems.default') === 'cdn') {
            $location = config('filesystems.disks.cdn.url');
        }

        $image = $model->getFirstMedia($name) ?? null;

        if (!$image) {
            return (object)[
                'original' => $placeholder,
                'name' => $placeholder,
                'meta' => 'sem imagem',
            ];
        }

        return (object)[
            'original' => $image->getUrl(),
            'name' => $image->getUrl('thumb'),
            'meta' => optional($image->getCustomProperty('meta'))[app()->getLocale()],
        ];
    }
}

if (!function_exists('media_file')) {
    function media_file($model, $name)
    {
        $file = optional($model->getFirstMedia($name))->name;
        if (!$file) {
            return false;
        }

        return "/storage/{$file}";
    }
}

if (!function_exists('image_path_builder')) {
    function image_path_builder($image, $config)
    {
        $configPath = str_replace('=', '.', http_build_query($config, null, '/'));
        $dirname = str_replace('/storage/', '/', dirname($image));

        return trim($dirname . '/' . $configPath . '/' . basename($image), './');
    }
}