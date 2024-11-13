<?php

public class Alocacao {
    private int id_alocacao;
    private int id_cliente;
    private int id_automovel;
    private Date data_venda;

    // Getters and Setters
    public int getId_alocacao() { return id_alocacao; }
    public void setId_alocacao(int id_alocacao) { this.id_alocacao = id_alocacao; }
    public int getId_cliente() { return id_cliente; }
    public void setId_cliente(int id_cliente) { this.id_cliente = id_cliente; }
    public int getId_automovel() { return id_automovel; }
    public void setId_automovel(int id_automovel) { this.id_automovel = id_automovel; }
    public Date getData_venda() { return data_venda; }
    public void setData_venda(Date data_venda) { this.data_venda = data_venda; }

    // CRUD Operations
    public static void create(Connection conn, Alocacao alocacao) throws SQLException {
        String sql = "INSERT INTO alocacao (id_cliente, id_automovel, data_venda) VALUES (?, ?, ?)";
        try (PreparedStatement stmt = conn.prepareStatement(sql)) {
            stmt.setInt(1, alocacao.getId_cliente());
            stmt.setInt(2, alocacao.getId_automovel());
            stmt.setDate(3, new java.sql.Date(alocacao.getData_venda().getTime()));
            stmt.executeUpdate();
        }
    }

    public static Alocacao read(Connection conn, int id_alocacao) throws SQLException {
        String sql = "SELECT * FROM alocacao WHERE id_alocacao = ?";
        try (PreparedStatement stmt = conn.prepareStatement(sql)) {
            stmt.setInt(1, id_alocacao);
            try (ResultSet rs = stmt.executeQuery()) {
                if (rs.next()) {
                    Alocacao alocacao = new Alocacao();
                    alocacao.setId_alocacao(rs.getInt("id_alocacao"));
                    alocacao.setId_cliente(rs.getInt("id_cliente"));
                    alocacao.setId_automovel(rs.getInt("id_automovel"));
                    alocacao.setData_venda(rs.getDate("data_venda"));
                    return alocacao;
                }
            }
        }
        return null;
    }

    public static void update(Connection conn, Alocacao alocacao) throws SQLException {
        String sql = "UPDATE alocacao SET id_cliente = ?, id_automovel = ?, data_venda = ? WHERE id_alocacao = ?";
        try (PreparedStatement stmt = conn.prepareStatement(sql)) {
            stmt.setInt(1, alocacao.getId_cliente());
            stmt.setInt(2, alocacao.getId_automovel());
            stmt.setDate(3, new java.sql.Date(alocacao.getData_venda().getTime()));
            stmt.setInt(4, alocacao.getId_alocacao());
            stmt.executeUpdate();
        }
    }

    public static void delete(Connection conn, int id_alocacao) throws SQLException {
        String sql = "DELETE FROM alocacao WHERE id_alocacao = ?";
        try (PreparedStatement stmt = conn.prepareStatement(sql)) {
            stmt.setInt(1, id_alocacao);
            stmt.executeUpdate();
        }
    }

    public static List<Alocacao> getAll(Connection conn) throws SQLException {
        String sql = "SELECT * FROM alocacao";
        List<Alocacao> list = new ArrayList<>();
        try (Statement stmt = conn.createStatement(); ResultSet rs = stmt.executeQuery(sql)) {
            while (rs.next()) {
                Alocacao alocacao = new Alocacao();
                alocacao.setId_alocacao(rs.getInt("id_alocacao"));
                alocacao.setId_cliente(rs.getInt("id_cliente"));
                alocacao.setId_automovel(rs.getInt("id_automovel"));
                alocacao.setData_venda(rs.getDate("data_venda"));
                list.add(alocacao);
            }
        }
        return list;
    }
}
?>