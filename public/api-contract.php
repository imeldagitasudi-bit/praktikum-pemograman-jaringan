<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&family=Nunito:wght@400;700&display=swap');

    body {
        font-family: 'Poppins', 'Nunito', sans-serif;
        background: linear-gradient(135deg, #ffd6f9 0%, #ffe6f7 100%);
        color: #444;
        margin: 40px;
    }

    h1 {
        text-align: center;
        color: #ff4da6;
        font-size: 2.2em;
        letter-spacing: 2px;
        text-shadow: 1px 1px 3px rgba(255, 0, 122, 0.2);
        margin-bottom: 30px;
    }

    table {
        border-collapse: collapse;
        width: 90%;
        margin: auto;
        background: #fff9fc;
        box-shadow: 0 4px 15px rgba(255, 105, 180, 0.2);
        border: 3px solid #ffb6d9;
        border-radius: 15px;
        overflow: hidden;
        transition: 0.3s;
    }

    table:hover {
        transform: scale(1.02);
        box-shadow: 0 6px 20px rgba(255, 105, 180, 0.25);
    }

    th {
        background: linear-gradient(135deg, #ff8fce, #ff5ab4);
        color: white;
        text-transform: uppercase;
        letter-spacing: 1px;
        padding: 14px;
        font-size: 0.9em;
    }

    td {
        padding: 12px 16px;
        border-bottom: 2px dashed #ffd1ec;
        text-align: center;
        font-size: 0.95em;
    }

    tr:hover td {
        background-color: #fff1f9;
        transition: 0.3s;
    }

    tr:last-child td {
        border-bottom: none;
    }
</style>

<h1>API Contract</h1>
<table border="0">
    <tr>
        <th>Endpoint</th>
        <th>Method</th>
        <th>Autentikasi</th>
        <th>Params / Body</th>
        <th>Respon</th>
    </tr>

    <!-- HEALTH CHECK -->
    <tr>
        <td>/api/v1/health</td>
        <td>GET</td>
        <td>-</td>
        <td>-</td>
        <td>{status: "ok"}</td>
    </tr>

    <!-- API CONTRACT -->
    <tr>
        <td>/api/v1/contract</td>
        <td>GET</td>
        <td>-</td>
        <td>-</td>
        <td>{contract}</td>
    </tr>

    <!-- AUTH LOGIN -->
    <tr>
        <td>/api/v1/auth/login</td>
        <td>POST</td>
        <td>-</td>
        <td>{email, password}</td>
        <td>{token}</td>
    </tr>

    <!-- GET ALL USERS -->
    <tr>
        <td>/api/v1/users</td>
        <td>GET</td>
        <td>Bearer</td>
        <td>page, per_page</td>
        <td>Meta{...}, Data{...}</td>
    </tr>

    <!-- GET USER BY ID -->
    <tr>
        <td>/api/v1/users/{id}</td>
        <td>GET</td>
        <td>Bearer</td>
        <td>{id}</td>
        <td>{id, name, email, role, ...}</td>
    </tr>

    <!-- CREATE USER -->
    <tr>
        <td>/api/v1/users</td>
        <td>POST</td>
        <td>Bearer (admin)</td>
        <td>{name, email, password, role}</td>
        <td>Created (201)</td>
    </tr>

    <!-- UPDATE USER -->
    <tr>
        <td>/api/v1/users/{id}</td>
        <td>PUT</td>
        <td>Bearer (admin)</td>
        <td>{name?, email?, password?, role?}</td>
        <td>Updated (200)</td>
    </tr>

    <!-- DELETE USER -->
    <tr>
        <td>/api/v1/users/{id}</td>
        <td>DELETE</td>
        <td>Bearer (admin)</td>
        <td>{id}</td>
        <td>Deleted (200)</td>
    </tr>

    <!-- FILE UPLOAD -->
    <tr>
        <td>/api/v1/upload</td>
        <td>POST</td>
        <td>Bearer</td>
        <td>{file}</td>
        <td>{filename, url}</td>
    </tr>

    <!-- API VERSION -->
    <tr>
        <td>/api/v1/version</td>
        <td>GET</td>
        <td>-</td>
        <td>-</td>
        <td>{version}</td>
    </tr>

</table>
