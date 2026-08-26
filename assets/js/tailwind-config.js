tailwind.config = {
    darkMode: 'class', // Ativa o modo escuro baseado na classe 'dark' ou 'light'
    theme: {
        extend: {
            colors: {
                bg: 'var(--bg)',
                'bg-2': 'var(--bg-2)',
                'bg-card': 'var(--bg-card)',
                'text-primary': 'var(--text)',
                'text-muted': 'var(--text-muted)',
            },
            backgroundImage: {
                'grad-primary': 'linear-gradient(135deg, #6c63ff 0%, #ff6584 50%, #ffa94d 100%)',
                'grad-hero': 'var(--grad-hero)',
                'grad-html': 'linear-gradient(135deg, #e34c26, #f06529)',
                'grad-css': 'linear-gradient(135deg, #264de4, #2965f1)',
                'grad-js': 'linear-gradient(135deg, #f7df1e, #ffa500)',
                'grad-python': 'linear-gradient(135deg, #3776ab, #ffd43b)',
            }
        }
    }
}
