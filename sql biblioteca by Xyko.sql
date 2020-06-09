-- todos os livros  que estão emprestados
SELECT e.*, p.nome, o.Descricao 
FROM tbemprestimos e JOIN tbpessoas p 
ON e.idpessoa = p.id JOIN tbobras o 
ON e.idobra = o.id WHERE e.datahoradevolucao is null

-- todos os livros que podem ser emprestados
SELECT DISTINCT o.*
FROM tbobras o
WHERE o.id
NOT IN ( -- não está contido
-- não foram devolvidos ainda select interno
SELECT DISTINCT e.idobra
FROM tbemprestimos e
WHERE e.datahoradevolucao is null
)

-- pessoas que nunca pegaram livros
SELECT DISTINCT p.* FROM tbpessoas p WHERE p.id NOT IN ( 
    -- não está contido -- não foram devolvidos ainda select interno 
    SELECT DISTINCT e.idpessoa FROM tbemprestimos e )

-- livros que nunca foram emprestados
SELECT DISTINCT o.* FROM tbobras o WHERE o.id NOT IN ( 
    -- não está contido -- não foram devolvidos ainda select interno 
    SELECT DISTINCT e.idobra FROM tbemprestimos e )


