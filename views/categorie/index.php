{{ include('layouts/header.php', { title: 'Categorie'})}}
    <h1>Categorie</h1>
    <table>
        <thead>
            <tr>
                <th>Nom</th>
            </tr>
        </thead>
        <tbody>
        {% for categorie in categories %}
            <tr>
                <td><a href="{{ base }}/categorie/show?id={{ categorie.id }}">{{ categorie.nom }}</a></td>

            </tr>
        {% endfor %}
        </tbody>
    </table>
    <a href="{{ base }}/categorie/create" class="btn" >Categorie Create</a>

    {{ include('layouts/footer.php') }}
