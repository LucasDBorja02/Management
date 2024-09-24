import sqlite3

def adicionar_coluna_status():
    db_path = 'C:/Users/ld388/Desktop/management/site/pages/vendas.db'
    conn = sqlite3.connect(db_path)
    c = conn.cursor()

    # Adicionar a coluna 'status' se ela não existir
    try:
        c.execute("ALTER TABLE vendas ADD COLUMN status TEXT DEFAULT 'Em Preparo'")
        conn.commit()
    except sqlite3.OperationalError:
        # A coluna já existe
        pass

    conn.close()

# Chame essa função uma vez para garantir que a coluna seja adicionada
adicionar_coluna_status()
