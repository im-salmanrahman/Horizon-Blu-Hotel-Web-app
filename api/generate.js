// api/generate.js (place this inside the 'api' folder)
const express = require('express');
const cors = require('cors');
const { GoogleGenerativeAI } = require('@google/generative-ai');

const app = express();

// Enable CORS for all origins (for development/demo purposes).
// In production, you might want to restrict this to your specific frontend domain.
app.use(cors({ origin: '*' })); 
app.use(express.json()); // To parse JSON request bodies

// This is the Vercel serverless function handler
module.exports = async (req, res) => {
    // Only allow POST requests
    if (req.method !== 'POST') {
        return res.status(405).json({ error: 'Method Not Allowed' });
    }

    // Retrieve API key from environment variables (SECURE WAY)
    const GEMINI_API_KEY = process.env.GEMINI_API_KEY; 

    if (!GEMINI_API_KEY) {
        // Log an error to Vercel logs, but send a generic message to client
        console.error('Server configuration error: GEMINI_API_KEY environment variable not set.');
        return res.status(500).json({ error: 'Server configuration error. Please contact support.' });
    }

    const genAI = new GoogleGenerativeAI(GEMINI_API_KEY);
    const model = genAI.getGenerativeModel({ model: 'gemini-2.0-flash' });

    const { contents } = req.body; // Expecting 'contents' array from frontend

    if (!contents || !Array.isArray(contents)) {
        return res.status(400).json({ error: 'Invalid request: "contents" array is required.' });
    }

    try {
        const result = await model.generateContent({ contents });
        const response = await result.response;
        const text = response.text();
        res.status(200).json({ text });
    } catch (error) {
        console.error('Error calling Gemini API from proxy:', error);
        res.status(500).json({ error: 'Failed to get a response from the AI service.' });
    }
};