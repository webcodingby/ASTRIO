<?php
function isCorrectHtmlStructure($tags)
{
    $stack = [];

    foreach ($tags as $tag) {
        if (strpos($tag, '</') === 0) { // это закрывающий тег
            $expectedOpenTag = '</' . substr($tag, 2);
            if (end($stack) === $expectedOpenTag) {
                array_pop($stack); // закрывающий тег совпадает с последним открытым, удаляем его из стека
            } else {
                return false; // некорректная структура
            }
        } else { // это открывающий тег
            $stack[] = '<' . substr($tag, 1);
        }
    }

    return empty($stack); // стек должен быть пустым, если все теги правильно закрыты
}
