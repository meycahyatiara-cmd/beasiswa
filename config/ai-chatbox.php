<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Active Provider
    |--------------------------------------------------------------------------
    */

    'active_provider' => 'groq',

    /*
    |--------------------------------------------------------------------------
    | Response Language
    |--------------------------------------------------------------------------
    */

    'language' => 'Bahasa Indonesia',

    /*
    |--------------------------------------------------------------------------
    | System Prompt
    |--------------------------------------------------------------------------
    */

    'system_prompt' => 'Anda adalah asisten AI yang ramah dan membantu untuk website KampusTopIndonesia. Anda bertugas membantu pengguna mencari informasi seputar kampus dan beasiswa. Anda harus selalu merespons dalam {language} saja, tidak peduli dalam bahasa apa pun pengguna menulis.',

    /*
    |--------------------------------------------------------------------------
    | Route Configuration
    |--------------------------------------------------------------------------
    */

    'route_prefix' => 'ai-chatbox',

    /*
    |--------------------------------------------------------------------------
    | Health Check
    |--------------------------------------------------------------------------
    | Dimatikan (false) agar tidak error E05
    */

    'health_check' => false, 
    'offline_message' => 'Layanan AI sedang tidak dapat dihubungi.',

    /*
    |--------------------------------------------------------------------------
    | SSRF Protection
    |--------------------------------------------------------------------------
    */

    'ssrf_protection' => false, 
    
    // KITA HAPUS 'ai-chatbox.cors' DARI SINI AGAR TIDAK BENTROK DENGAN LARAVEL
    'middleware' => ['web'], // Hapus 'throttle:20,1' untuk sementara

    /*
    |--------------------------------------------------------------------------
    | CORS — Allowed Origins
    |--------------------------------------------------------------------------
    */

    'allowed_origins' => ['*'],

    /*
    |--------------------------------------------------------------------------
    | Rate Limiting
    |--------------------------------------------------------------------------
    */

    'rate_limit' => env('AI_CHATBOX_RATE_LIMIT', 20),
    'rate_window' => env('AI_CHATBOX_RATE_WINDOW', 1),

    /*
    |--------------------------------------------------------------------------
    | Widget Appearance
    |--------------------------------------------------------------------------
    */

    'title' => env('AI_CHATBOX_TITLE', 'Asisten KampusTopID'),
    'placeholder' => 'Ketik pesan Anda...',
    'theme_color' => '#6C5CE7',
    'greeting' => 'Halo! Ada yang bisa saya bantu terkait beasiswa hari ini?',

    /*
    |--------------------------------------------------------------------------
    | Toggle Button Icon
    |--------------------------------------------------------------------------
    */

    'toggle_icon' => null,

    /*
    |--------------------------------------------------------------------------
    | Color Scheme
    |--------------------------------------------------------------------------
    */

    'color_scheme' => 'auto',

    /*
    |--------------------------------------------------------------------------
    | Frontend Driver
    |--------------------------------------------------------------------------
    */

    'frontend' => 'vue', 

    /*
    |--------------------------------------------------------------------------
    | Markdown Rendering
    |--------------------------------------------------------------------------
    */

    'markdown' => true,

    /*
    |--------------------------------------------------------------------------
    | Sound Notification
    |--------------------------------------------------------------------------
    */

    'sound' => true,
    'sound_volume' => 0.3,

    /*
    |--------------------------------------------------------------------------
    | Widget Position
    |--------------------------------------------------------------------------
    */

    'position' => 'bottom-right',

    /*
    |--------------------------------------------------------------------------
    | Conversation History
    |--------------------------------------------------------------------------
    */

    'history_enabled' => env('AI_CHATBOX_HISTORY', true),
    'history_limit' => 50,

    /*
    |--------------------------------------------------------------------------
    | Context Token Limit
    |--------------------------------------------------------------------------
    */

    'context_token_limit' => 4000,

    /*
    |--------------------------------------------------------------------------
    | Token Streaming (Server-Sent Events)
    |--------------------------------------------------------------------------
    | DIMATIKAN PAKSA (false) KARENA SERING ERROR 404 DI LOKAL
    */

    'stream' => false, 

    /*
    |--------------------------------------------------------------------------
    | Client-side Storage Driver
    |--------------------------------------------------------------------------
    */

    'storage' => 'local',

    /*
    |--------------------------------------------------------------------------
    | AI Response Tuning
    |--------------------------------------------------------------------------
    */

    'max_tokens' => 300,
    'temperature' => 0.5,

    /*
    |--------------------------------------------------------------------------
    | Request Timeout
    |--------------------------------------------------------------------------
    */

    'timeout' => env('AI_CHATBOX_TIMEOUT', 30),

    /*
    |--------------------------------------------------------------------------
    | RAG — Retrieval-Augmented Generation
    |--------------------------------------------------------------------------
    */

    'rag_enabled' => env('AI_CHATBOX_RAG', false),
    'rag_embedding_timeout' => (int) env('AI_CHATBOX_EMBEDDING_TIMEOUT', 10),
    'rag_top_k' => 10,
    'rag_chunk_size' => 500,
    'rag_chunk_overlap' => 50,
    'rag_similarity_threshold' => 0.2,
    'rag_keyword_fallback' => env('AI_CHATBOX_RAG_KEYWORD_FALLBACK', true),
    'rag_keyword_stop_words' => [
        'what', 'which', 'where', 'when', 'how', 'why', 'who',
        'the', 'this', 'that', 'these', 'those',
        'are', 'was', 'were', 'will', 'would', 'can', 'could',
        'should', 'shall', 'may', 'might', 'must',
        'have', 'has', 'had', 'does', 'did',
        'for', 'and', 'but', 'not', 'you', 'your',
        'apa', 'siapa', 'dimana', 'kapan', 'bagaimana', 'mengapa', 'yang', 'dan', 'atau', 'ini', 'itu'
    ],
    'rag_admin_middleware' => ['web', 'auth'],
    'admin_middleware' => null,

    /*
    |--------------------------------------------------------------------------
    | RAG Context Prompt
    |--------------------------------------------------------------------------
    */

    'rag_context_prompt' => "Answer the user's question using ONLY the knowledge-base excerpts below. "
    . "Do not use any prior or general knowledge, and do not add facts that are not present in these excerpts. "
    . "If the excerpts do not contain the answer, reply exactly: \"I don't have that information in my knowledge base.\" "
    . "You may still respond naturally to greetings, thanks, and small talk.\n\n"
    . "Context:\n{chunks}",

    /*
    |--------------------------------------------------------------------------
    | RAG No-Context Prompt (grounding guard)
    |--------------------------------------------------------------------------
    */

    'rag_no_context_prompt' => "No relevant knowledge-base entries were found for this question. "
    . "If the user is asking for information or a factual answer, do not answer from general knowledge — "
    . "reply exactly: \"I don't have that information in my knowledge base.\" "
    . "You may still respond naturally to greetings, thanks, and small talk.",

    /*
    |--------------------------------------------------------------------------
    | Memory Driver
    |--------------------------------------------------------------------------
    */

    'memory_driver' => env('AI_CHATBOX_MEMORY_DRIVER', 'database'),

    /*
    |--------------------------------------------------------------------------
    | Conversation Pruning
    |--------------------------------------------------------------------------
    */

    'conversation_prune_days' => 30,

    /*
    |--------------------------------------------------------------------------
    | RAG Processing Time Limit
    |--------------------------------------------------------------------------
    */

    'rag_processing_timeout' => (int) env('AI_CHATBOX_RAG_PROCESSING_TIMEOUT', 0),

    /*
    |--------------------------------------------------------------------------
    | Named AI Providers
    |--------------------------------------------------------------------------
    */

    'providers' => [

        'lmstudio' => [
            'api_url' => env('LMSTUDIO_URL', 'http://127.0.0.1:1234/v1/chat/completions'),
            'api_token' => env('LMSTUDIO_TOKEN', 'lmstudio'),
            'api_model' => env('LMSTUDIO_MODEL', 'phi-3.5-mini-instruct'),
            'rag_embedding_url' => env('LMSTUDIO_EMBEDDING_URL', 'http://127.0.0.1:1234/v1/embeddings'),
            'rag_embedding_model' => env('LMSTUDIO_EMBEDDING_MODEL', 'text-embedding-nomic-embed-text-v1.5'),
        ],

        'ollama' => [
            'api_url' => env('OLLAMA_URL', 'http://localhost:11434/v1/chat/completions'),
            'api_token' => env('OLLAMA_TOKEN', 'your-ollama-token'),
            'api_model' => env('OLLAMA_MODEL', 'gpt-oss:120b'),
            'rag_embedding_url' => env('OLLAMA_EMBEDDING_URL', 'http://localhost:11434/v1/embeddings'),
            'rag_embedding_model' => env('OLLAMA_EMBEDDING_MODEL', 'nomic-embed-text'),
        ],

        'openai' => [
            'api_url' => env('OPENAI_URL', ''),
            'api_token' => env('OPENAI_API_KEY', ''),
            'api_model' => env('OPENAI_MODEL', ''),
            'rag_embedding_url' => env('OPENAI_EMBEDDING_URL', ''),
            'rag_embedding_model' => env('OPENAI_EMBEDDING_MODEL', ''),
        ],

        'anthropic' => [
            'engine' => 'anthropic',
            'api_url' => env('ANTH_URL', 'https://api.anthropic.com/v1/messages'),
            'api_token' => env('ANTH_API_KEY', ''),
            'api_model' => env('ANTH_MODEL', 'claude-sonnet-4-6'),
            'anthropic_version' => env('ANTH_VERSION', '2023-06-01'),
            'rag_embedding_url' => env('ANTH_EMBEDDING_URL', ''),
            'rag_embedding_model' => env('ANTH_EMBEDDING_MODEL', ''),
            'rag_embedding_token' => env('ANTH_EMBEDDING_TOKEN', ''),
        ],

         'groq' => [
            'api_url' => 'https://api.groq.com/openai/v1/chat/completions',
            'api_token' => env('GROQ_API_KEY', ''),
            'api_model' => 'openai/gpt-oss-120b', 
        ],

    ],

];