<?php

public class Cliente {
    private int id_cliente;
    private String nome;
    private String email;
    private String telefone;
    private String endereco;

    // Getters and Setters
    public int getId_cliente() { return id_cliente; }
    public void setId_cliente(int id_cliente) { this.id_cliente = id_cliente; }
    public String getNome() { return nome; }
    public void setNome(String nome) { this.nome = nome; }
    public String getEmail() { return email; }
    public void setEmail(String email) { this.email = email; }
    public String getTelefone() { return telefone; }
    public void setTelefone(String telefone) { this.telefone = telefone; }
    public String getEndereco() { return endereco; }
    public void setEndereco(String endereco) { this.endereco = endereco; }

    // CRUD Operations
    public static void create(Connection conn, Cliente cliente) throws SQLException {
        String sql = "INSERT INTO cliente (nome, email, telefone, endereco) VALUES (?, ?, ?, ?)";
        try (PreparedStatement stmt = conn.prepareStatement(sql)) {
            stmt.setString(1, cliente.getNome());
            stmt.setString(2, cliente.getEmail());
            stmt.setString(3, cliente.getTelefone());
            stmt.setString(4, cliente.getEndereco());
            stmt.executeUpdate();
        }
    }

    public static Cliente read(Connection conn, int id_cliente) throws SQLException {
        String sql = "SELECT * FROM cliente WHERE id_cliente = ?";
        try (PreparedStatement stmt = conn.prepareStatement(sql)) {
            stmt.setInt(1, id_cliente);
            try (ResultSet rs = stmt.executeQuery()) {
                if (rs.next()) {
                    Cliente cliente = new Cliente();
                    cliente.setId_cliente(rs.getInt("id_cliente"));
                    cliente.setNome(rs.getString("nome"));
                    cliente.setEmail(rs.getString("email"));
                    cliente.setTelefone(rs.getString("telefone"));
                    cliente.setEndereco(rs.getString("endereco"));
                    return cliente;
                }
            }
        }
        return null;
    }

    public static void update(Connection conn, Cliente cliente) throws SQLException {
        String sql = "UPDATE cliente SET nome = ?, email = ?, telefone = ?, endereco = ? WHERE id_cliente = ?";
        try (PreparedStatement stmt = conn.prepareStatement(sql)) {
            stmt.setString(1, cliente.getNome());
            stmt.setString(2, cliente.getEmail());
            stmt.setString(3, cliente.getTelefone());
            stmt.setString(4, cliente.getEndereco());
            stmt.setInt(5, cliente.getId_cliente());
            stmt.executeUpdate();
        }
    }

    public static void delete(Connection conn, int id_cliente) throws SQLException {
        String sql = "DELETE FROM cliente WHERE id_cliente = ?";
        try (PreparedStatement stmt = conn.prepareStatement(sql)) {
            stmt.setInt(1, id_cliente);
            stmt.executeUpdate();
        }
    }

    public static List<Cliente> getAll(Connection conn) throws SQLException {
        String sql = "SELECT * FROM cliente";
        List<Cliente> list = new ArrayList<>();
        try (Statement stmt = conn.createStatement(); ResultSet rs = stmt.executeQuery(sql)) {
            while (rs.next()) {
                Cliente cliente = new Cliente();
                cliente.setId_cliente(rs.getInt("id_cliente"));
                cliente.setNome(rs.getString("nome"));
                cliente.setEmail(rs.getString("email"));
                cliente.setTelefone(rs.getString("telefone"));
                cliente.setEndereco(rs.getString("endereco"));
                list.add(cliente);
            }
        }
        return list;
    }
}
?>