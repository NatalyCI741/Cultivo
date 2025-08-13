import 'package:flutter/material.dart';
import 'package:intl/intl.dart';
import '../services/cultivo_service.dart';
import '../models/cultivo.dart';
import 'crear_cultivo_screen.dart';
import 'package:http/http.dart' as http;
import 'dart:convert';
import 'package:provider/provider.dart';

class CultivoListScreen extends StatefulWidget {
  const CultivoListScreen({super.key});

  @override
  State<CultivoListScreen> createState() => _CultivoListScreenState();
}

class _CultivoListScreenState extends State<CultivoListScreen> {
  final CultivoService _service = CultivoService();
  late Future<List<Cultivo>> _futureCultivos;

  @override
  void initState() {
    super.initState();
    _refreshCultivos();
  }

  void _refreshCultivos() {
    setState(() {
      _futureCultivos = _service.getCultivos();
    });
  }

  Future<void> _navigateToCreateScreen(BuildContext context) async {
    final result = await Navigator.push(
      context,
      MaterialPageRoute(builder: (context) => const CrearCultivoScreen()),
    );
    if (mounted && result == true) {
      _refreshCultivos();
    }
  }

  Widget _buildCultivoCard(Cultivo cultivo) {
    return Card(
      margin: const EdgeInsets.symmetric(horizontal: 16, vertical: 8),
      elevation: 4,
      shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(12)),
      child: ListTile(
        leading: const Icon(Icons.agriculture, size: 32, color: Colors.green),
        title: Text(
          cultivo.nombre,
          style: const TextStyle(fontWeight: FontWeight.bold, fontSize: 16),
        ),
        subtitle: Text(
          cultivo.tipo != null && cultivo.fecha != null
              ? 'Tipo: ${cultivo.tipo} \nFecha: ${DateFormat('dd/MM/yyyy').format(cultivo.fecha!)}'
              : cultivo.tipo ?? 'Sin tipo',
        ),
        isThreeLine: true,
      ),
    );
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('Gestión de Cultivos'),
        backgroundColor: Colors.green.shade700,
        actions: [
          IconButton(
            icon: const Icon(Icons.refresh),
            tooltip: 'Actualizar',
            onPressed: _refreshCultivos,
          ),
        ],
      ),
      body: FutureBuilder<List<Cultivo>>(
        future: _futureCultivos,
        builder: (context, snapshot) {
          if (snapshot.connectionState == ConnectionState.waiting) {
            return const Center(child: CircularProgressIndicator());
          } else if (snapshot.hasError) {
            return Center(
              child: Padding(
                padding: const EdgeInsets.all(16),
                child: Column(
                  mainAxisAlignment: MainAxisAlignment.center,
                  children: [
                    Icon(Icons.error_outline, color: Colors.red.shade400, size: 48),
                    const SizedBox(height: 12),
                    Text(
                      'Error al cargar cultivos:\n${snapshot.error}',
                      textAlign: TextAlign.center,
                      style: const TextStyle(fontSize: 16),
                    ),
                    const SizedBox(height: 20),
                    ElevatedButton.icon(
                      icon: const Icon(Icons.refresh),
                      label: const Text('Reintentar'),
                      onPressed: _refreshCultivos,
                      style: ElevatedButton.styleFrom(backgroundColor: Colors.green),
                    ),
                  ],
                ),
              ),
            );
          } else if (snapshot.hasData && snapshot.data!.isNotEmpty) {
            final cultivos = snapshot.data!;
            return RefreshIndicator(
              onRefresh: () async => _refreshCultivos(),
              child: ListView.builder(
                physics: const AlwaysScrollableScrollPhysics(),
                itemCount: cultivos.length,
                itemBuilder: (context, index) => _buildCultivoCard(cultivos[index]),
              ),
            );
          } else {
            return const Center(
              child: Text(
                'No hay cultivos registrados.',
                style: TextStyle(fontSize: 18, color: Colors.grey),
              ),
            );
          }
        },
      ),
      floatingActionButton: FloatingActionButton.extended(
        onPressed: () => _navigateToCreateScreen(context),
        label: const Text('Nuevo Cultivo'),
        icon: const Icon(Icons.add),
        backgroundColor: Colors.green.shade700,
      ),
    );
  }
}

class User {
  final String id;
  final String email;
  final String role; // 'admin' o 'cliente'
  final String name;

  User({
    required this.id,
    required this.email,
    required this.role,
    required this.name,
  });
}

class AuthService {
  Future<User?> login(String email, String password) async {
    try {
      // Aquí implementarías la llamada a tu API
      final response = await http.post(
        Uri.parse('tu_url_api/login'),
        body: {
          'email': email,
          'password': password,
        },
      );

      if (response.statusCode == 200) {
        // Guardar el token y la información del usuario
        final userData = json.decode(response.body);
        return User(
          id: userData['id'],
          email: userData['email'],
          role: userData['role'],
          name: userData['name'],
        );
      }
      return null;
    } catch (e) {
      return null;
    }
  }
}

class AuthProvider extends ChangeNotifier {
  User? _user;
  bool get isAuthenticated => _user != null;
  bool get isAdmin => _user?.role == 'admin';
  bool get isCliente => _user?.role == 'cliente';

  Future<bool> login(String email, String password) async {
    final authService = AuthService();
    final user = await authService.login(email, password);
    
    if (user != null) {
      _user = user;
      notifyListeners();
      return true;
    }
    return false;
  }

  void logout() {
    _user = null;
    notifyListeners();
  }
}

class LoginScreen extends StatefulWidget {
  @override
  _LoginScreenState createState() => _LoginScreenState();
}

class _LoginScreenState extends State<LoginScreen> {
  final _emailController = TextEditingController();
  final _passwordController = TextEditingController();

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: Padding(
        padding: EdgeInsets.all(16.0),
        child: Column(
          mainAxisAlignment: MainAxisAlignment.center,
          children: [
            TextField(
              controller: _emailController,
              decoration: InputDecoration(labelText: 'Email'),
            ),
            SizedBox(height: 16),
            TextField(
              controller: _passwordController,
              decoration: InputDecoration(labelText: 'Contraseña'),
              obscureText: true,
            ),
            SizedBox(height: 24),
            ElevatedButton(
              onPressed: () async {
                final success = await context.read<AuthProvider>().login(
                  _emailController.text,
                  _passwordController.text,
                );
                
                if (success) {
                  // Navegar a la pantalla correspondiente según el rol
                  if (context.read<AuthProvider>().isAdmin) {
                    Navigator.pushReplacement(
                      context,
                      MaterialPageRoute(builder: (_) => AdminDashboard()),
                    );
                  } else {
                    Navigator.pushReplacement(
                      context,
                      MaterialPageRoute(builder: (_) => ClienteDashboard()),
                    );
                  }
                } else {
                  ScaffoldMessenger.of(context).showSnackBar(
                    SnackBar(content: Text('Error de autenticación')),
                  );
                }
              },
              child: Text('Iniciar Sesión'),
            ),
          ],
        ),
      ),
    );
  }
}

class AuthGuard extends StatelessWidget {
  final Widget child;
  final String requiredRole;

  AuthGuard({
    required this.child,
    required this.requiredRole,
  });

  @override
  Widget build(BuildContext context) {
    return Consumer<AuthProvider>(
      builder: (context, auth, _) {
        if (!auth.isAuthenticated) {
          return LoginScreen();
        }

        if (auth._user?.role != requiredRole) {
          return Scaffold(
            body: Center(
              child: Text('No tienes permisos para acceder a esta página'),
            ),
          );
        }

        return child;
      },
    );
  }
}