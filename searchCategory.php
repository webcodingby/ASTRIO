<?php

function searchCategory($categories, $id)
{
    foreach ($categories as $category)
    {
        if ($category['id'] == $id)
        {
            return $category['title'];
        }

        if (isset($category['children']))
        {
            $result = searchCategory($category['children'], $id);
            if ($result !== null)
            {
                return $result;
            }
        }
    }
    return null;
}
