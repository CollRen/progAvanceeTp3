<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ title }}</title>
    <link rel="stylesheet" href="{{ asset }}/css/style.css">
    <link rel="stylesheet" href="{{ asset }}/css/main.css">
</head>

<body>
    <nav>
        <ul>
            <!-- Menu administrateur -->
            {% if session.privilege_id == 1 %}
            <li><a href="{{base}}/user/create">Users</a></li>
            <li><a href="{{base}}/auteur">Auteurs</a></li>
            <li><a href="{{base}}/ingredient">Ingrédients</a></li>
            <li><a href="{{base}}/categorie">Catégorie</a></li>
            <li><a href="{{base}}/ingredientCat">Catégorie d'ingrédients</a></li>
            <li><a href="{{base}}/umesure">Unité de mesure</a></li>
            {% endif %}


            <!-- Menu auteur -->
            {% if session.privilege_id == 2 %}
            <li><a href="{{base}}/recette">Liste de recette</a></li>
            <li><a href="{{base}}/ingredient">Ingrédients</a></li>

            {% endif %}

            <!-- Menu invité -->

            
            
            
            {% if guest %}
            <li><a href="{{base}}/recette">Liste de recette</a></li>
            <li><a href="{{base}}/login">Login</a></li>
            {% else %}
            <li><a href="{{base}}/logout">Logout</a></li>
            {% endif %}
        </ul>
    </nav>
    <main>


        {% if guest is empty %}
        Bienvenu {{ session.user_name }},
        {% endif %}