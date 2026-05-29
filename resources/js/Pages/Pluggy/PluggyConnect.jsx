import { PluggyConnect } from 'react-pluggy-connect'
import { useState, useEffect } from 'react'

export default function OpenFinanceConnect() {
    const [connectToken, setConnectToken] = useState(null)

    useEffect(() => {
        fetch('/api/v1/pluggy/create-token', {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json'
            }
        })
            .then(res => res.json())
            .then(data => setConnectToken(data.accessToken))
    }, [])

    if (!connectToken) return <div>Carregando...</div>

    return (
        <PluggyConnect
            connectToken={connectToken}
            includeSandbox={true}
            onSuccess={(itemData) => {
                console.log('Conectado!', itemData)

                fetch('/api/v1/pluggy/item', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({
                        itemId: itemData.item.id
                    })
                })
            }}
            onError={(error) => {
                console.error('Erro na conexão', error)
            }}
        />
    )
}
