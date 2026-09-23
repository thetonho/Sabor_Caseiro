SABOR CASEIRO — DESIGN ORIGINAL + SUPABASE

1. O design original (HTML/CSS/imagens) foi mantido como base.
2. A integração fica em supabase.js + integration.js.
3. supabase.js já está configurado com a Project URL e a Publishable Key informadas.
4. Rode banco_supabase.sql no SQL Editor do Supabase se ainda não tiver criado as tabelas.
5. Abra o projeto por Live Server (não por file://).
6. Para tornar uma conta administradora:
   update public.usuarios set tipo = 'Administrador' where email = 'seu@email.com';
7. Nunca coloque sb_secret_... no frontend.
