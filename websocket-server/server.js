const WebSocket = require('ws');

const wss = new WebSocket.Server({ host: '0.0.0.0', port: 8080 });

const myDevicesMacAddress = ["E8:9F:6D:FE:5E:60"];
let letState = "off";

wss.on('connection', (ws) => {
    console.log('Client connected');

    ws.on('message', (message) => {
        const messageStr = message.toString();

        try {
            const parsedMessage = JSON.parse(messageStr);

            // Verifică dacă MAC address-ul este în lista de dispozitive
            if (myDevicesMacAddress.includes(parsedMessage.macAddress)) {
                // Trimite mesajul imediat către ESP32
                wss.clients.forEach(client => {
                    if (client !== ws && client.readyState === WebSocket.OPEN) {
                        client.send(JSON.stringify({
                            status: "connected",
                            ledState: parsedMessage.ledState,
                            macAddress: parsedMessage.macAddress,
                        }));
                    }
                });
            }
        } catch (error) {
            console.error('Failed to parse message as JSON', error);
        }
    });

    ws.on('close', () => {
        console.log('Client disconnected');
    });
});

console.log('WebSocket server is running on ws://localhost:8080');
