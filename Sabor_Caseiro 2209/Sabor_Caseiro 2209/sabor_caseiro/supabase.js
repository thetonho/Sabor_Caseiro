const SUPABASE_URL = 'https://bbguspmkegjrsyfcqaxy.supabase.co';
const SUPABASE_PUBLISHABLE_KEY = 'sb_publishable_9K73pJ8leAiRtwM13jp0fA_yh88wmV6';
const supabaseClient = supabase.createClient(SUPABASE_URL, SUPABASE_PUBLISHABLE_KEY);
window.db = supabaseClient;
window.supabaseConfigurado = true;
