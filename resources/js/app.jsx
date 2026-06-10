import React from 'react';
import { createRoot } from 'react-dom/client';

export default function HelloReact() {
    return (
        <div style={{ padding: '20px', backgroundColor: '#1e293b', color: 'white', borderRadius: '10px', textAlign: 'center', marginTop: '30px' }}>
            <h2 style={{ fontSize: '24px', fontWeight: 'bold', marginBottom: '10px' }}>Hello from React!</h2>
            <p>React has been successfully integrated into your Laravel application.</p>
        </div>
    );
}

if (document.getElementById('react-root')) {
    const root = createRoot(document.getElementById('react-root'));
    root.render(<HelloReact />);
}
