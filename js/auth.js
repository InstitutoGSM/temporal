export async function getUser() {
  const res = await fetch('api_auth.php?action=get_user');
  const data = await res.json();
  return data.user ?? null;
}

export async function getPerfil(userId) {
  const res = await fetch(`api_auth.php?action=get_perfil&id=${userId}`);
  return await res.json();
}

export async function logout() {
  await fetch('api_auth.php?action=logout');
  window.location.href = 'catalogo.php';
}

export async function requireAuth(redirigirSi = null) {
  const user = await getUser();
  if (!user) { window.location.href = 'login.php'; return null; }
  const perfil = await getPerfil(user.id);
  if (redirigirSi && perfil?.tipo !== redirigirSi) { window.location.href = 'index.php'; return null; }
  return { user, perfil };
}

export async function requireAdmin() {
  const user = await getUser();
  if (!user) { window.location.href = 'admin-login.php'; return null; }
  const perfil = await getPerfil(user.id);
  if (perfil?.tipo !== 'admin') { window.location.href = 'index.php'; return null; }
  return { user, perfil };
}