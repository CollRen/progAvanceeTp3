{{ include('layouts/header.php', { title: 'Aj Auteur'})}}
    <h1>Auteurs</h1>
    <table>
        <thead>
            <tr>
                <th>Prénom</th>
                <th>Nom</th>
            </tr>
        </thead>
        <tbody>
        {% for auteur in auteurs %}
            <tr>
                <td><a href="{{ base }}/auteur/show?id={{ auteur.id }}">{{ auteur.prenom }}</a></td>
                <td>{{ auteur.nom }}</td>
            </tr>
        {% endfor %}
        </tbody>
    </table>
    <a href="{{ base }}/auteur/create" class="btn" >Ajouter un auteur</a>

    {{ include('layouts/footer.php') }}
